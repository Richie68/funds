## Local Installation

### Clone Repo to your computer

git clone git@github.com:Richie68/funds.git

### cd to folder and install Composer dependencies

composer install or composer update

###  Install packages

npm install

### Build assets

npm run dev

###  Set up configuration

cp .env.example .env

### Generate application key

php artisan key:generate

### Create SQLite database

touch database/database.sqlite

### Run migrations:

php artisan migrate

### Seed tables

php artisan db:seed

### Run php server

php artisan serve

### See the site on localhost

- You will see the login page. Provide the credentials that are shown on the login card
