chown -R webapp:webapp /var/www/lrs/var

chmod 755 /var/config/dump.sh

php-fpm -F