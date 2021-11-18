service php7.4-fpm start

php artisan route:clear

service nginx start

tail -f /var/log/nginx/access.log /var/log/nginx/error.log