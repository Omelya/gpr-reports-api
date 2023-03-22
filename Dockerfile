FROM webdevops/php-nginx:8.0

COPY . /app

RUN  cp /app/docker/config/nginx/app.conf /opt/docker/etc/nginx/vhost.conf \
         && pecl install xdebug \
         && docker-php-ext-enable xdebug

EXPOSE 80

PORT 80

VOLUME ["/app/storage/logs"]

WORKDIR /app
