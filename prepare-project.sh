#!/usr/bin/bash
# Prepare project
cd laravel
composer install # pull down lots of packages, may take 10+ minutes if not cached
cp .env.example .env # copy example .env configuration, missing APP_KEY
php artisan key:generate # fill in the APP_KEY in the .env file
sed -i '/APP_NAME/s/^.*$/APP_NAME="Quotes System"/' .env
sed -i '/DB_/s/^/#/' .env
echo -e "DB_CONNECTION=sqlite\nDB_FOREIGN_KEYS=true" >> .env
touch database/database.sqlite
# Update files
./update-files.sh