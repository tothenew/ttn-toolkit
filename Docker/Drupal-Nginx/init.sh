#!/bin/bash
set -xe
date

composer require --dev drush/drush
composer install

sed -i 's/pm.max_children = 5/pm.max_children = 90/g' /etc/php/8.1/fpm/pool.d/www.conf
sed -i 's/memory_limit = 128M/memory_limit = 8024M/g' /etc/php/8.1/fpm/php.ini
sed -i 's/max_execution_time = 30/max_execution_time = 300/g' /etc/php/8.1/fpm/php.ini
sed -i 's/post_max_size = 8M/post_max_size = 32M/g' /etc/php/8.1/fpm/php.ini
sed -i 's/upload_max_filesize = 2M/upload_max_filesize = 32M/g' /etc/php/8.1/fpm/php.ini
sed -i 's/;max_input_vars = 1000/max_input_vars = 10000/g' /etc/php/8.1/fpm/php.ini

/etc/init.d/php8.1-fpm start
nginx -t
service nginx start&
date
vendor/bin/drush updb || true
vendor/bin/drush cim -y || true
vendor/bin/drush cr  || true
vendor/bin/drush cim -y || true
vendor/bin/drush cr || true
date
service nginx restart

