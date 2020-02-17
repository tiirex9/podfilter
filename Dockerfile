FROM webdevops/php-nginx:alpine-php7

ENV WEB_DOCUMENT_ROOT /app/public

USER application
WORKDIR /app

COPY src/composer.json src/composer.lock ./
RUN set -eux; \
  composer global require hirak/prestissimo; \
  composer install --prefer-dist --no-dev --no-progress --no-autoloader; \
  rm -rf ~/.composer/cache

ENV APP_NAME=Podfilter APP_DEBUG=false APP_URL=http://localhost APP_TIMEZONE=Europe/Berlin
COPY src ./

RUN set -eux; \
    composer dump-autoload -o
