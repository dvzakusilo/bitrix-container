#!/bin/sh

chown -R www-data /var/www

exec runuser -u www-data "$@"