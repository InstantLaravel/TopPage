#!/bin/bash

while :
do
    if [ -e /home/home/restart-required ]
    then
        # serviceコマンドの出力はnullへ流さないとシェル中の起動は安定しない
        service nginx force-reload &> /dev/null
        service php5-fpm stop &> /dev/null
        service php5-fpm start &> /dev/null
        rm /home/home/restart-required
    fi
    sleep 30
done
