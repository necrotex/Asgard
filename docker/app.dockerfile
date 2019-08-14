ARG PHP_VERSION=7.3.3
ARG WITH_XDEBUG=false

FROM php:${PHP_VERSION}-fpm

RUN apt-get update && \
    apt -y install lsb-release apt-transport-https ca-certificates wget apt-utils mysql-client

RUN wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg && \
    echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/php7.3.list

RUN apt-get install -y -q --no-install-recommends libmcrypt-dev libmagickwand-dev git libzip-dev libfreetype6-dev libjpeg62-turbo-dev libpng-dev supervisor cron

RUN pecl install imagick && \
    docker-php-ext-enable imagick && \
    docker-php-ext-install pdo_mysql && \
    docker-php-ext-install bcmath && \
    docker-php-ext-install intl && \
    docker-php-ext-install zip && \
    docker-php-ext-install bz2 && \
    docker-php-ext-install exif && \
    docker-php-ext-install xml && \
    docker-php-ext-install pcntl && \
    docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ && \
    docker-php-ext-install gd && \
    docker-php-ext-configure opcache --enable-opcache && \
    docker-php-ext-install opcache

RUN if [ "$WITH_XDEBUG" = "true" ]; then \
    pecl install xdebug && docker-php-ext-enable xdebug \
;fi

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer

COPY ./config/laravel.crontab /etc/cron.d
COPY ./config/supervisor.conf /etc/supervisor/conf.d

USER root
RUN service supervisor start

# Clean up
RUN apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* && \
    rm /var/log/lastlog /var/log/faillog

RUN usermod -u 1000 www-data

USER www-data
WORKDIR /var/www
