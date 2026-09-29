FROM php:8.2-apache

# Menginstal fungsi PostgreSQL untuk PHP
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# Menyalin seluruh file kodingan Anda ke server
COPY . /var/www/html/

# Membuka akses port web
EXPOSE 80