FROM php:8.2-cli
#add the certificate at project file
COPY transcontinental_nips.crt /usr/local/share/ca-certificates/transcontinental_nips.crt
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    ca-certificates \
    libzip-dev \
    && update-ca-certificates \
    && docker-php-ext-install zip pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html