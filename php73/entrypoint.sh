#!/bin/sh

# chown -R www-data /var/www

echo "listen = 127.0.0.1:9000" > /etc/php/7.3/fpm/pool.d/www.conf