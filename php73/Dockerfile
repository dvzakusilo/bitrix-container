FROM php:7.3-fpm

RUN apt update && apt install -y curl wget gnupg 

RUN echo "deb https://debian.octopuce.fr/snapshots/sury-php/20220630/ stretch main" | tee /etc/apt/sources.list.d/php.list && \
    wget -qO - https://debian.octopuce.fr/sury-php/apt.gpg | apt-key add -

RUN docker-php-ext-install mysqli 
RUN docker-php-ext-enable mysqli

RUN apt-get update \
    && apt-get -y --no-install-recommends install \
    php7.3-memcached \
    php7.3-memcache \
    php7.3-mbstring \
    php7.3-mysql \
    php7.3-mysqli \
    php7.3-intl \
    php7.3-interbase \
    php7.3-xdebug \
    php7.3-soap \
    php7.3-gd \
    php7.3-imagick \
    php7.3-ldap \
    php7.3-opcache \
    php7.3-zip \
    php7.3-redis \
    php7.3-phalcon \
    php-pear php-dev libmcrypt-dev gcc make autoconf libc-dev pkg-config \
    && pecl install mcrypt-1.0.3 \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# DO NOT install php7.3-xdebug package for site running in production! It will slow it down significantly.

COPY ./php.ini /etc/php/7.3/fpm/conf.d/90-php.ini
COPY ./php.ini /etc/php/7.3/cli/conf.d/90-php.ini

RUN curl -sL https://deb.nodesource.com/setup_14.x | bash - && \
    curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - && \
    echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list

RUN chown -R www-data:www-data "/var/www/"

WORKDIR "/home/www-data/"

RUN usermod  -u 33 www-data


RUN apt-get update && \
    apt-get install -qq -y build-essential nodejs yarn \
    libpq-dev  



RUN npm install npm@6.14.0

EXPOSE 9000
