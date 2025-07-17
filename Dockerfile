# Define PHP version as build arg
ARG PHP_VERSION=8.1

# Use PHP version dynamically (must repeat ARG here!)
FROM php:${PHP_VERSION}-apache
ARG HOST_UID=1000
ARG HOST_GID=1000
ARG PHP_VERSION

# Install dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    libonig-dev \
    gettext \
    unzip \
    zip \
    yaz \
    libyaz-dev \
    gcc \
    make \
    autoconf \
    pkg-config \
 && docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install -j$(nproc) gd mbstring mysqli pdo pdo_mysql gettext zip \
 && pecl install yaz \
 && docker-php-ext-enable yaz \
 && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache rewrite
RUN a2enmod rewrite

# Set Apache to run as host user for editable volumes
RUN groupmod -g ${HOST_GID} www-data && \
    usermod -u ${HOST_UID} -g ${HOST_GID} www-data

USER www-data
WORKDIR /var/www/html
