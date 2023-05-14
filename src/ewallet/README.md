# CollectiveBank Web App Documentation

CollectiveBank is a web application built with the Laravel framework. It is developed for the "Coding Collective" coding interview. The application utilizes PHP, Nginx, MySQL, and WebSockets for asynchronous notifications. This document provides an overview of the web app and its Docker Compose configuration.

## Docker Compose Configuration

The following is the `docker-compose.yml` configuration file for running the CollectiveBank web app:

```yaml
version: '3.8'

services:
  nginx:
    image: nginx:1.21
    ports:
      - 80:80
    volumes:
      - ./src:/var/www/php
      - ./.docker/nginx/conf.d:/etc/nginx/conf.d
    depends_on:
      - php

  php:
    build: ./.docker/php
    working_dir: /var/www/php
    volumes:
      - ./src:/var/www/php
      - ./supervisor:/etc/supervisor/conf.d
      - ./src/ewallet/storage/logs:/var/www/php/ewallet/storage/logs
    ports:
      - 3000:3000

  laravel-horizon:
    build:
      context: ./.docker/laravel-horizon
    volumes:
      - ./src:/var/www/php
      - ./.docker/laravel-horizon/supervisord.d:/etc/supervisord.d
    ports:
      - 6001:6001
    depends_on:
      - php

  mysql:
    image: mysql/mysql-server:8.0
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_ROOT_HOST: "%"
      MYSQL_DATABASE: demo
    volumes:
      - ./.docker/mysql/my.cnf:/etc/mysql/my.cnf
      - ./data/mysql:/var/lib/mysql
    healthcheck:
      test: mysqladmin ping -h 127.0.0.1 -u root --password=$$MYSQL_ROOT_PASSWORD
      interval: 5s
      retries: 10
    ports:
      - 3305:3306

  redis:
    image: redis:alpine
    container_name: redis
    command: redis-server --requirepass secret
    volumes:
      - ./data/redis:/data
    ports:
      - "6379:6379"

  composer:
    build: ./.docker/php
    volumes:
      - ./src/ewallet:/var/www/php/ewallet
    command: bash -c "composer install && composer dump-autoload && php artisan migrate:fresh --seed && npm install && npm run build"
    working_dir: /var/www/php/ewallet
    depends_on:
      - php
```

This configuration defines the following services:

- **nginx**: Nginx service responsible for serving the web application. It listens on port 80 and forwards requests to the PHP service.
- **php**: PHP service built using the provided Dockerfile. It hosts the Laravel application and mounts the necessary volumes for source code, logs, and supervisor configuration. It listens on port 3000.
- **laravel-horizon**: Laravel Horizon service built using the provided Dockerfile. It mounts the necessary volumes for source code and supervisord configuration. It listens on port 6001.
- **mysql**: MySQL service using the `mysql/mysql-server:8.0` image. It sets up the MySQL database for the application, with the root password as "root". It mounts volumes for MySQL configuration and data storage. It listens on port 3305.
- **redis**: Redis service using the `redis:alpine` image. It runs Redis server with a password "secret".
