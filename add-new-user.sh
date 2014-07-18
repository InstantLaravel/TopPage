#/bin/bash

# 最初の引数 : 作成するユーザー

# ユーザー作成
useradd --home-dir /home/$1 --create-home --user-group $1

# .profileへumask追加
echo "umask 002" >> /home/$1/.profile

# baseの環境をコピー
cp -R /home/codiad/workspace/base /home/codiad/workspace/$1

# ファイル所有者変更
chmod -R $1:codiad /home/codiad/workspace/$1

# パーミッション変更
find /home/codiad/workspace/$1 -type d -exec sudo chmod 2775 {}
find /home/codiad/workspace/$1 -type f -exec sudo chmod 0664 {}

# 仮想ホスト作成
baseDomain='*** Base Domain Name ***';
docRoot='*** Doc Root ***';
cat <<EOT > /etc/nginx/sites-available/$1
server {
        listen 80;
        server_name $1.${baseDomain};

        root /home/codiad/workspace/base/${docRoot};

        index index.html index.php;

        location ~ / {
                try_files \$uri \$uri/ /index.php?\$query_string;
                location ~ \\.php$ {
                        include fastcgi_params;
                        # SCRIPT_FILENAMEをオーバーライト
                        fastcgi_param SCRIPT_FILENAME  \$document_root\$fastcgi_script_name;
                        fastcgi_split_path_info ^(.+\\.php)(/.+)$;
                        fastcgi_pass unix:/var/run/php5-fpm.$1.sock;
                        fastcgi_index index.php;
                }
        }

        location = favicon.ico { access_log off; log_not_found off; }
        location = robots.txt { access_log off; log_not_found off; }

        access_log off;
        error_log /var/log/nginx/error.log error;
#       rewrite_log on;

        error_page 404 /index.php;

        sendfile off;
}
EOT

# PHP-FPMプール作成
cat <<EOT > /etc/php5/fpm/pool.d/$1.conf
[base]
user = $1
group = $1
listen = /var/run/php5-fpm.$1.sock
listen.owner = $1
listen.group = $1
listen.mode = 0666
pm = dynamic
pm.max_children = 5
pm.start_servers = 2
pm.min_spare_servers = 1
pm.max_spare_servers = 3
chdir = /
php_admin_value[disable_functions] = dl,exec,passthru,shell_exec,system,proc_open,popen,curl_exec,curl_multi_exec,parse_ini_file,show_source
EOT

# Nginx、php5-fpm再起動
service nginx restart
service php5-fpm restart
