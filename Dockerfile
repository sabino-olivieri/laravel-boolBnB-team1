FROM php:8.2-apache

# Installa dipendenze di sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Installa estensioni PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Installa Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Imposta directory di lavoro
WORKDIR /var/www/html

# Copia i file del progetto
COPY . .

# Installa dipendenze PHP
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Imposta permessi
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Configura Apache per puntare a /public
RUN a2enmod rewrite
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Esegui migrazioni e avvia Apache
CMD php artisan migrate --force && apache2-foreground