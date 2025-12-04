FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
 && docker-php-ext-install pdo_mysql mbstring zip gd \
 && a2enmod rewrite \
 && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Agora o Laravel está em /var/www/html/app
WORKDIR /var/www/html/app

# Apache aponta para o public do Laravel
RUN sed -ri -e 's!/var/www/html!/var/www/html/app/public!g' /etc/apache2/sites-available/000-default.conf \
 && echo '<Directory /var/www/html/app/public>\n\tAllowOverride All\n</Directory>' >> /etc/apache2/apache2.conf
