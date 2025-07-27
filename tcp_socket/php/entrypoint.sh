#!/bin/sh
addgroup -S nginx
adduser -S nginx -G nginx
chown -R nginx:nginx /var/run/php-fpm
exec php-fpm
