FROM phpdockerio/php73-fpm:latest

RUN apt-get update \
    && apt-get -y --no-install-recommends install \
    php7.3-memcached \
    php7.3-memcache \
    php7.3-mbstring \
    php7.3-mysql \
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

# In image have 8.2, update for checkout to 7.3
RUN update-alternatives --set php /usr/bin/php7.3

#RUN chmode 777 /var/www/.npm




RUN curl -sL https://deb.nodesource.com/setup_14.x | bash - && \
    curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - && \
    echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list && \
    apt-get update && \
    apt-get install -qq -y build-essential nodejs yarn \
    libpq-dev \
    mysql-client

WORKDIR "/var/www/"


RUN npm install npm@6.14.0
#RUN rm -rf /usr/local/lib/node_modules/npm
#RUN mv node_modules/npm /usr/local/lib/node_modules/npm

RUN usermod -u 1000 www-data

WORKDIR "/var/www/bitrix"

EXPOSE 9000
