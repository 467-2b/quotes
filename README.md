# CSCI 467 Group Project - Group 2B - Quotes System

## Docs

* [SQL](sql/README.md)

## Setup Instructions

The below instructions are the steps needed to download all of the prerequesites on Ubuntu 20.04. It can be either a real Ubuntu or Ubuntu on WSL. Follow these instructions to set up Ubuntu 20.04 on WSL. https://wiki.ubuntu.com/WSL

**Initial setup (automated)**
```sh
# Install dependencies from apt
sudo apt update
sudo apt upgrade -y
sudo apt install -y git

# Download the code and run setup script
git clone https://github.com/467-2b/quotes.git
cd quotes
./install.sh
```

**Setting up the database for the first time**
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

# Add the credentials to the legacy DB from Blackboard
LEGACY_DB_CONNECTION=mysql
LEGACY_DB_HOST=127.0.0.1
LEGACY_DB_PORT=3306
LEGACY_DB_DATABASE=
LEGACY_DB_USERNAME=
LEGACY_DB_PASSWORD=
```

Then run these commands: 
```sh
touch database/database.sqlite
php artisan migrate:fresh --seed
```

**Updating project files and database**
```sh
cd laravel
./update-files.sh
```

**Testing**
```sh
# Bring up the application at http://localhost:8000/
php artisan serve
```