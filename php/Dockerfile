FROM php:7.4-fpm-alpine

# Install nginx/supervisor.d
RUN docker-php-ext-install bcmath pdo_mysql; \
    docker-php-ext-enable bcmath pdo_mysql

RUN apk update; \
    apk add supervisor nginx; \
    mkdir /run/nginx

COPY php/supervisord.conf /etc/supervisord.conf
COPY php/site.conf /etc/nginx/conf.d/default.conf

# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"; \
    php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"; \
    php composer-setup.php --install-dir /usr/local/bin --filename composer ; \
    php -r "unlink('composer-setup.php');"

WORKDIR /app
COPY --chown=www-data src/composer.json src/composer.lock ./
RUN set -eux; \
    composer install --prefer-dist --no-dev --no-progress --no-autoloader; \
    rm -rf ~/.composer/cache

ENV APP_NAME=Podfilter APP_DEBUG=false APP_TIMEZONE=Europe/Berlin
COPY --chown=www-data src ./

RUN set -eux; \
    composer dump-autoload -o

VOLUME /app/storage/artworks
CMD ["/usr/bin/supervisord"]
