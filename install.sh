#!/usr/bin/bash
# Environment setup script

# Install dependencies from apt
sudo apt update && \
sudo apt upgrade -y && \
sudo apt install -y build-essential git php php-pear php-dev libmcrypt-dev php-fpm php-zip php-mbstring php-xml php-gd mysql-client php-mysql sqlite3 php-sqlite3

# Install php-mcrypt from pecl
if php -m | grep mcrypt; then
    echo "Mcrypt already installed"
else
    sudo pecl channel-update pecl.php.net
    sudo pecl update-channels
    printf "\n" | sudo pecl install mcrypt
    echo -e "; Enable mcrypt extension module\nextension=mcrypt.so" | sudo tee /etc/php/7.4/mods-available/mcrypt.ini
    sudo phpenmod -s ALL mcrypt
    php -m | grep mcrypt # To test if mcrypt is working, grep should print out "mcrypt" in red if enabled, or print nothing if not enabled
fi

# Update from Composr 1 to 2
sudo apt purge -y composer
hash -d composer # Make bash forget about the old composer
curl -sS https://getcomposer.org/installer -o composer-setup.php
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer

# Uninstall the version of nodejs and npm packaged with Ubuntu 20.04
sudo apt purge -y npm nodejs
# Install nodejs 15 from nodesource 
curl -fsSL https://deb.nodesource.com/setup_15.x | sudo -E bash -
sudo apt-get install -y nodejs

# Prepare project
cd laravel
composer install # pull down lots of packages, may take 10+ minutes if not cached
cp .env.example .env # copy example .env configuration, missing APP_KEY
php artisan key:generate # fill in the APP_KEY in the .env file
sed -i '/DB_/s/^/#/' .env
echo -e "DB_CONNECTION=sqlite\nDB_FOREIGN_KEYS=true" >> .env
touch database/database.sqlite
php artisan migrate
php artisan db:seed
npm install # pull down npm packages
npm run dev # compile assets