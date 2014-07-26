#/bin/bash

# 最初の引数 : 作成するユーザー

# ユーザー作成
useradd --home-dir /home/$1 --create-home --user-group $1

# .profileへumask追加
echo "umask 002" >> /home/$1/.profile

# baseの環境をコピー
cp -R /home/codiad/workspace/base /home/codiad/workspace/$1

# ファイル所有者変更
chown -R $1:codiad /home/codiad/workspace/$1

# パーミッション変更
find /home/codiad/workspace/$1 -type d -exec sudo chmod 2775 {} +
find /home/codiad/workspace/$1 -type f -exec sudo chmod 0664 {} +

# ユーザーごとの実行結果表示用Nginx定義追加
cat <<EOT > /etc/nginx/users.d/$1
    location ~ ^/$1(/(.+))?$ {
        root /home/codiad/workspace/$1/public;

        try_files \$1 /$1/index.php?\$query_string;

        location ~ ^/$1/index.php$ {
            include fastcgi_params;
            # パラメーターをオーバーライト
            fastcgi_param SCRIPT_FILENAME /home/codiad/workspace/$1/public/index.php;
            fastcgi_split_path_info ^(.+\\.php)(.+)$;
            fastcgi_pass unix:/var/run/php5-fpm.$1.sock;
            fastcgi_index index.php;
        }
    }
EOT

# PHP-FPMプール作成
cat <<EOT > /etc/php5/fpm/pool.d/$1.conf
[$1]
user = $1
group = $1
listen = /var/run/php5-fpm.$1.sock
listen.owner = $1
listen.group = www-data
listen.mode = 0660
# プロセス数を固定:static 動的に管理:dynamic アクセス時startの数だけプロセス起動:ondemand
pm = ondemand
# プロセス最大数 staticの場合はプロセス数
pm.max_children = 2
# 予め起動しておくプロセス数 ondemandの場合は初期起動数
pm.start_servers = 2
# アイドル状態時の最小プロセス数 dynamicの場合のみ
pm.min_spare_servers = 1
# アイドル状態時の最大プロセス数 dynamicの場合のみ
pm.max_spare_servers = 2
chdir = /
php_admin_value[disable_functions] = dl,exec,passthru,shell_exec,system,proc_open,popen,curl_exec,curl_multi_exec,parse_ini_file,show_source
EOT

# Nginx、php5-fpm再起動要求
touch /home/home/restart-required
