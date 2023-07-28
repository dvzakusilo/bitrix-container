FROM php:7.3-fpm

RUN apt update && apt install -y curl wget gnupg libpng-dev libzip-dev libxml2-dev

RUN echo "deb https://debian.octopuce.fr/snapshots/sury-php/20220630/ stretch main" | tee /etc/apt/sources.list.d/php.list && \
    wget -qO - https://debian.octopuce.fr/sury-php/apt.gpg | apt-key add -

RUN mkdir -p /usr/src/php/ext/redis; \
	curl -fsSL https://pecl.php.net/get/redis --ipv4 | tar xvz -C "/usr/src/php/ext/redis" --strip 1; 


RUN apt-get update \
    && apt-get -y --no-install-recommends install \
    zlib1g-dev libbz2-dev bz2 \
    && pecl install mcrypt-1.0.3 redis  \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/* 

RUN docker-php-ext-install  mysqli mbstring zip gd  redis soap sockets pdo pdo_mysql
RUN docker-php-ext-enable mysqli  redis

# DO NOT install php7.3-xdebug package for site running in production! It will slow it down significantly.

COPY ./php.ini /etc/php/7.3/fpm/conf.d/90-php.ini
COPY ./php.ini /etc/php/7.3/cli/conf.d/90-php.ini
COPY ./php.ini /usr/local/etc/php/conf.d/90-php.ini

RUN curl -sL https://deb.nodesource.com/setup_14.x | bash - && \
    curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - && \
    echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list

RUN chown -R www-data:www-data "/var/www/"

WORKDIR "/home/www-data/"

RUN usermod  -u 33 www-data

RUN wget -cO - https://getcomposer.org/composer-stable.phar > /usr/local/bin/composer
RUN chmod 755 /usr/local/bin/composer

RUN apt-get update && \
    apt-get install -qq -y build-essential nodejs yarn \
    libpq-dev  && \
    npm install pm2 -g



RUN npm install npm@6.14.0

EXPOSE 9000
