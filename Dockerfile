## deployed from jenkins.zahir.dev
FROM ubuntu:24.04 as builder

ENV TZ=Asia/Jakarta
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN mkdir -p /app
WORKDIR /app

RUN apt update
RUN apt-get install -y software-properties-common
RUN add-apt-repository ppa:ondrej/php
RUN apt update
RUN apt install -y curl nginx php8.4 php8.4-bz2 php8.4-cli php8.4-curl php8.4-fpm php8.4-gd php8.4-interbase php8.4-mbstring php8.4-mcrypt php8.4-mysql php8.4-opcache php8.4-pgsql php8.4-redis php8.4-xml php8.4-zip php8.4-fileinfo ca-certificates
COPY . /app


COPY --from=composer:2.2.21 /usr/bin/composer /usr/local/bin/composer
#RUN composer global require kylekatarnls/update-helper


# RUN composer config --no-plugins allow-plugins.kylekatarnls/update-helper true
RUN composer install

RUN mkdir -p /app/storage/logs
RUN chown www-data:www-data -Rf *



RUN mkdir -p /run/php
COPY nginx.conf /etc/nginx/sites-available/default

CMD ["/bin/bash", "-c", "php-fpm8.4 && nginx -g 'daemon off;'"]
