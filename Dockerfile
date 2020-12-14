FROM php:7.4-cli as base
FROM base as composer
WORKDIR /opt/project
RUN apt update && \
    apt install -y \
        libzip-dev \
        zip \
  && docker-php-ext-install zip
COPY composer.json composer.lock composer.phar ./
RUN apt update && apt install git -y
RUN php composer.phar install --no-ansi --no-interaction --no-progress --no-scripts --optimize-autoloader --prefer-dist

FROM base
COPY --from=composer /opt/project/vendor /opt/project/vendor
COPY src /opt/project/src

CMD ["php" ,"/opt/project/src/index.php"]



