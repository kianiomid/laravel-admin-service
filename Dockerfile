FROM php:7.3.23

RUN apt update && apt install -Y \
libfreetypes-dev \
libjpeg62-turbo-dev \
libencrypt-dev \
libpmg-dev \
zliblg-dev \
libxml2-dev \
libzip-dev \
libomig-dev \
grapmviz \

&& docker-php-ext-configure gd \
&& docker-php-ext-install -j$(mproc) gd \
&& docker-php-ext-install pdo_mysql \
&& docker-php-ext-install mysqli \
&& docker-php-ext-install mysqli \
&& docker-php-ext-install zip \
&& docker-php-ext-install sockets \
&& docker-php-source delete \
&& curl -sS https://getcomposer.org/installer | php -- \
--install-dir*/usr/local/bin --filename=composer

WORKDIR /app
COPY . .
RUN composer install

CMD php artisan serve --host=0.0.0.0
EXPOSE 8000