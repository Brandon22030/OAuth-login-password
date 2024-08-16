FROM php:8.2

RUN apt-get update -y && apt-get install -y openssl zip unzip git

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN ["docker-php-ext-install", "pdo", "pdo_mysql"]

WORKDIR /app

COPY . .

RUN composer install

RUN php artisan key:generate

RUN npm install

RUN npm run dev

EXPOSE 8001

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8001"]