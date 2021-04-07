# CSCI 467 Group Project - Group 2B - Quotes System

## Docs

* [SQL](sql/README.md)

## Setup Instructions

The below instrrrctions are the steps needed to download all of the prerequesites on Ubuntu 20.04. It can be either a real Ubuntu or Ubuntu on WSL. Follow these instructions to set up Ubuntu 20.04 on WSL. https://wiki.ubuntu.com/WSL

**Initial setup (automated)**
```sh
# Install dependencies from apt
sudo apt update
sudo apt upgrade -y
sudo apt install -y build-essential git php php-pear php-dev libmcrypt-dev php-fpm php-zip php-mbstring php-xml php-gd mysql-client php-mysql sqlite3 php-sqlite3

# Install php-mcrypt from pecl
sudo pecl channel-update pecl.php.net
sudo pecl update-channels
printf "\n" | sudo pecl install mcrypt
echo -e "; Enable mcrypt extension module\nextension=mcrypt.so" | sudo tee /etc/php/7.4/mods-available/mcrypt.ini
sudo phpenmod -s ALL mcrypt
php -m | grep mcrypt # To test if mcrypt is working, grep should print out "mcrypt" in red if enabled, or print nothing if not enabled

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

# Create a place for the projects to live, and move there
mkdir -p Projects
cd Projects

# Download the code
git clone https://github.com/467-2b/quotes.git
cd quotes

# Prepare project
git checkout update-laravel-version # switch to the branch with new laravel
git pull
rm -rf html
cd laravel
cp .env.example .env # copy example .env configuration, missing APP_KEY
composer install # pull down lots of packages, may take 10+ minutes if not cached
npm install # pull down npm packages
npm run dev # compile assets
php artisan key:generate # fill in the APP_KEY in the .env file
```

**Setting up the database**
open the .env file, and find the MySQL database section and make these changes:
```ini
# MySQL Database
#DB_CONNECTION=mysql
#DB_HOST=127.0.0.1
#DB_PORT=3306
#DB_DATABASE=laravel
#DB_USERNAME=root
#DB_PASSWORD=

# SQLite database
DB_CONNECTION=sqlite
#DB_DATABASE=../database/database.sqlite
DB_FOREIGN_KEYS=true
```

Then run these commands: 
```sh
touch database/database.sqlite
php artisan migrate
```

**Testing**
```sh
# Bring up the application at http://localhost:8000/
php artisan serve
```