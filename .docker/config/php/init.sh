echo "*/2 * * * * application php /var/www/symfony/bin/console crontasks:run > /dev/null" > /etc/cron.d/entrili && chmod 644 /etc/cron.d/entrili

chown -R webapp:webapp /var/www/symfony/var

chmod 755 /var/config/dump.sh

php-fpm -F