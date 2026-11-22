FROM wordpress:7.1.5-php8.4-apache

# WordPress uses mysqli. Persian WooCommerce opens MySQL through PDO.
RUN docker-php-ext-install pdo_mysql
