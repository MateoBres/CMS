FROM ubuntu:20.04

MAINTAINER Attivi Digitali <info@attividigitali.com>

RUN apt update
# install curl
RUN apt install -y curl

RUN apt-get install php7.4-fpm php7.4-curl -y
RUN systemctl is-enabled php7.4-fpm

# install sqlite3
RUN apt-get install -y sqlite3 libsqlite3-dev

# install php dependencies
RUN apt install -y php-gd \
                php-common \
                php-opcache \
                php-imagick \
                php-mysqli \
                php-curl \
                php-json \
                php-phar \
                php-mbstring \
                php-xml \
                php-dom \
                php-xmlwriter \
                php-tokenizer \
                php-zip \
                php-soap

RUN apt install php7.4-sqlite3

COPY ./php.ini /etc/php/7.4/fpm/php.ini

# install nodejs and npm
RUN curl -sL https://deb.nodesource.com/setup_12.x | bash -
RUN apt-get install -y nodejs
RUN npm install npm@latest -g

RUN apt -y install nginx
# install composer
RUN curl -sS https://getcomposer.org/installer | php -- \
  --install-dir=/usr/bin --filename=composer

# rimuovo file default
RUN rm -f /etc/nginx/site-available/default
# copy custom default.conf in /etc/nginx/conf.d/default
COPY ./default.conf /etc/nginx/sites-available/default
COPY ./nginx.conf /etc/nginx/nginx.conf

# delete default index.html in html nginx
RUN rm -rf /var/www/html/index.html

# copy local app in html folder
COPY . /var/www/html
COPY .env.example /var/www/html/.env

# create sqlite database
RUN touch /var/www/html/database/database.sqlite

# set permission and owner of the folder html 
RUN chown -R www-data:www-data /var/www/html

# set work directory
WORKDIR /var/www/html

# install packages 
RUN composer install
RUN npm install
#RUN npm run production

#RUN composer dump-autoload
RUN php artisan key:generate
RUN php artisan migrate --seed --force
RUN php artisan passport:install
RUN php artisan db:seed --class=ItalianDistrictSeeder
RUN php artisan db:seed --class=RoleSeeder
RUN php artisan db:seed --class=RetailerTypeSeeder
RUN php artisan db:seed --class=CategorySeeder
RUN composer dump-autoload
#RUN php artisan db:seed 
#RUN php artisan storage:link

#RUN composer install --optimize-autoloader --no-dev
RUN npm run production

# optimize:
RUN php artisan optimize:clear
RUN php artisan optimize
#RUN php artisan route:cache
RUN php artisan config:cache
#RUN php artisan passport:install
RUN php artisan route:clear

# custom script for set php7.4-fpm, start nginx and php artisan commands
COPY start.sh /var/www/html/start.sh

EXPOSE 80


CMD ["nginx", "-g", "daemon off;"]

# start script
ENTRYPOINT ["sh", "./start.sh"]