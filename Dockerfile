FROM webdevops/php-nginx:8.0

COPY . /app

RUN  cp /app/docker/config/nginx/app.conf /opt/docker/etc/nginx/vhost.conf

EXPOSE 80

VOLUME ["/app/storage/logs"]

WORKDIR /app
