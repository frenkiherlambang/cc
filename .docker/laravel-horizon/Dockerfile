#
#--------------------------------------------------------------------------
# Image Setup
#--------------------------------------------------------------------------
#

FROM php:8.1-fpm

RUN apt-get update && \
    apt-get install -y --force-yes --no-install-recommends \
        libmemcached-dev \
        libzip-dev \
        libz-dev \
        libzip-dev \
        libpq-dev \
        libjpeg-dev \
        libpng-dev \
        libfreetype6-dev \
        libssl-dev \
        openssh-server \
        libmagickwand-dev \
        git \
        cron \
        nano \
        libxml2-dev \
        libreadline-dev \
        libgmp-dev \
        mariadb-client \
        unzip \
        supervisor


# Install the PHP pcntl extention
RUN docker-php-ext-install pcntl

# Install the PHP bcmath extention
RUN docker-php-ext-install bcmath

# Install the PHP pdo_mysql extention
RUN docker-php-ext-install pdo_mysql

RUN usermod -u 1000 www-data

COPY supervisord.conf /etc/supervisord.conf
COPY supervisord.d/laravel-horizon.conf /etc/supervisor/conf.d/laravel-horizon.conf

ENTRYPOINT ["/usr/bin/supervisord", "-n", "-c",  "/etc/supervisord.conf"]

#
#--------------------------------------------------------------------------
# Final Touch
#--------------------------------------------------------------------------
#

EXPOSE 6001
WORKDIR /etc/supervisor/conf.d/
