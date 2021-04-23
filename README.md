# CSCI 467 Group Project - Group 2B - Quotes System

## Docs

* [SQL](sql/README.md)

## Setup Instructions

The below instructions are the steps needed to download all of the prerequesites on Ubuntu 20.04. It can be either a real Ubuntu or Ubuntu on WSL. Follow these instructions to set up Ubuntu 20.04 on WSL. https://wiki.ubuntu.com/WSL

### Setup using docker

1. Download the `Dockerfile` and `entrypoint.sh` files and save them to some directory, eg. 'quotes'.
2. Either add your configuration to `entrypoint.sh` entrypoint.sh OR bind-mount a .env file into the container later.
3. Optional: If using SQLite3 database, create an empty database.sqlite file to mount into the container.
4. From the directory that containers  `Dockerfile` and `entrypoint.sh`, run this command to build the container image:
   `docker build --build-arg CACHEBUST=$(date +%s) --build-arg "CHECKOUT=develop" -t quotes`
5. Run this command to start the container:
   `docker run --name quotes -v /path/to/app/storage/quotes/database/database.sqlite:/app/database/database.sqlite -p 80:8000 -d quotes`

The Dockerfile can be modified to not require the `entrypoint.sh` script, but it is useful to run some pre-flight setup.

### Manual setup on Ubuntu 20.04

There are some scripts to help simplify installing the packages building the components, and preparing the database.

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