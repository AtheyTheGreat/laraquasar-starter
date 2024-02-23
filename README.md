laravel 10 vue 3 quasar v2.14.5 vite starter kit 
this porject will have vue 3 quasar served through laravel application with the help of vite pulgin and will have spaties 
media library, querybuilder and permissions setup in laravel.

1- clone repo
2- 
  a -if sail up
   docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
    
   b- if docker - do docker compose build
   c- doing locally just do an composer i 
3- npm install - dependences
4- setup .env variables
5- sail or php artisan migrate --seed to populate database
6- npm run dev - to serve

default admin panel logins are 
email : super@admin.com
password: password
