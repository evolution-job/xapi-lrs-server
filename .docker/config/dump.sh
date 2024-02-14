#!/usr/bin/env sh

# Be sure everything is accessible for webapp
chown -R webapp:webapp /var/www/lrs

su webapp sh <<EOF
echo "Start commands as webapp user"
cd /var/www/lrs

# Clear as a brand new App
rm -Rf /var/www/lrs/var/cache
rm -Rf /var/www/lrs/var/logs

# Composer command - Simulate Jenkins part
composer install --prefer-dist --optimize-autoloader

# Deploy commands - Simulate Ec2 with ElasticBeanstalk
php bin/console doctrine:migrations:migrate -n --allow-no-migration

# Deploy post-commands - Simulate Ec2 with ElasticBeanstalk
php bin/console cache:warmup --env=prod

EOF
echo "End of commands under webapp user"

chown -R webapp:webapp /var/www/lrs