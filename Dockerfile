FROM php:5.6-apache

# Enable required PHP extensions (mysql, mysqli, gd, etc.)
RUN sed -i 's|http://deb.debian.org/debian|http://archive.debian.org/debian|g; s|http://security.debian.org/debian-security|http://archive.debian.org/debian-security|g' /etc/apt/sources.list \
    && sed -i '/stretch-updates/d' /etc/apt/sources.list \
    && apt-get update -o Acquire::Check-Valid-Until=false --allow-insecure-repositories \
    && apt-get install -y --no-install-recommends --allow-unauthenticated libjpeg-dev libpng-dev libfreetype6-dev libmcrypt-dev \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install mysql mysqli pdo pdo_mysql gd mcrypt

# Enable Apache rewrite module (commonly needed)
RUN a2enmod rewrite
RUN echo "short_open_tag=On" > /usr/local/etc/php/conf.d/short_open_tag.ini
RUN echo "display_errors=Off" > /usr/local/etc/php/conf.d/display_errors.ini
RUN echo "date.timezone=UTC" > /usr/local/etc/php/conf.d/timezone.ini

# Copy project into container
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Document root points to public_html
ENV APACHE_DOCUMENT_ROOT /var/www/html/public_html
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

EXPOSE 80
CMD ["apache2-foreground"]
