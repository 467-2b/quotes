#!/usr/bin/bash
if [[ ! -f ".env" ]]  || [[ ! -s ".env" ]]; then # detect if .env is missing or empty
    cp .env.example .env # copy example .env configuration, missing APP_KEY
    sed -i '/APP_NAME/s/^.*$/APP_NAME="Quotes System"/' .env
    sed -i '/APP_ENV/s/^.*$/APP_ENV=production/' .env
    php artisan key:generate # fill in the APP_KEY in the .env file
    sed -i '/APP_DEBUG/s/^.*$/APP_DEBUG=false/' .env
    sed -i '/LOG_LEVEL/s/^.*$/LOG_LEVEL=warning/' .env
    if [[ -z "${DB_HOST}" ]]; then
        sed -i '/DB_/s/^/#/' .env
        echo -e "DB_CONNECTION=sqlite\nDB_FOREIGN_KEYS=true" >> .env
    else
        sed -i "/DB_HOST/s/=.*\$/=${DB_HOST}/" .env
    fi
	cat >> .env <<ENV && echo -e "\033[0;32mWrote .env\033[0m" || echo -e "\033[0;31mCould not write .env\033[0m";

LEGACY_DB_HOST=localhost
LEGACY_DB_PORT=3306
LEGACY_DB_DATABASE=
LEGACY_DB_USERNAME=root
LEGACY_DB_PASSWORD=

MAIL_FROM_ADDRESS=
MAIL_FROM_NAME=
MAIL_DRIVER=smtp
MAIL_HOST=
MAIL_PORT=465
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=ssl

ENV
fi
if grep -q 'DB_CONNECTION=sqlite' .env && [[ ! -f "database/database.sqlite" ]] || [[ ! -s "database/database.sqlite" ]]; then # If using sqlite database, detect if missing or empty
    touch database/database.sqlite
    php artisan migrate:fresh --seed --force
else
	php artisan migrate
fi
php artisan config:cache
exec "$@"
