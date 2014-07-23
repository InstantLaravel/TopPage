#!/bin/bash

while :
do
    if [ -e /home/home/restart-required ]
    then
        service nginx force-reload
        service php5-fpm stop
        service php5-fpm start
        rm /home/home/restart-required
    fi
    sleep 30
done
