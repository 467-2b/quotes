FROM ubuntu:20.04 AS base
ENV DEBIAN_FRONTEND=noninteractive
ENV TZ=America/Chicago
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y php php-fpm php-zip php-mbstring php-xml php-gd php-mysql sqlite3 php-sqlite3 && \
    apt-get autoremove && \
    apt-get clean

FROM base AS builder
WORKDIR /src
RUN apt-get install -y curl git imagemagick unzip
# The mcrypt module is no longer needed with the latest version of Laravel
#RUN pecl channel-update pecl.php.net && \
#    pecl update-channels && \
#    pecl install -s mcrypt && \
#    echo -e "; Enable mcrypt extension module\nextension=mcrypt.so" | tee /etc/php/7.4/mods-available/mcrypt.ini && \
#    phpenmod -s ALL mcrypt && \
#    php -m | grep mcrypt
RUN curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN curl -fsSL https://deb.nodesource.com/setup_15.x | bash - && \
    apt-get install -y nodejs
RUN git clone --depth 1 --no-single-branch https://github.com/467-2b/quotes.git && \
    cd quotes/laravel && \
    composer install --optimize-autoloader --no-dev && \
    cd ../..
ARG CACHEBUST
RUN echo $CACHEBUST
ARG CHECKOUT
RUN echo "Will build app from $CHECKOUT" && \
    cd quotes && \
    git fetch --all && \
    git checkout $CHECKOUT && \
    git pull -f || true; \
    rm -rf .git && \
    cd laravel && \
    composer install --optimize-autoloader --no-dev && \
    npm install && \
    npm run prod && \
    rm -rf node_modules && \
	php artisan view:cache && \
	cd public/img && \
	mogrify -resize 910x512 -quality 85 cover-*.jpg

FROM base
WORKDIR /app
COPY --from=builder /src/quotes/laravel/ .
COPY entrypoint.sh .
ENTRYPOINT ["./entrypoint.sh"]
CMD ["php", "artisan", "serve", "--host", "0.0.0.0"]

