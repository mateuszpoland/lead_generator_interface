FROM php:8.2-fpm as base

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    librabbitmq-dev \
    zip \
    unzip \
    libjudy-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd \
    && pecl install amqp \
    && pecl install memprof \
    && docker-php-ext-enable amqp

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www

COPY . .

RUN composer install

EXPOSE 9000

CMD ["php-fpm"]