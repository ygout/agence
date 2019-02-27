# Agence

Projet Agence immobilière avec le framework symfony 4

## Prerequisites

You need to install: 
* Composer: https://getcomposer.org/
* PHP 7.x: http://php.net/manual/fr/install.php
* MySql

## Getting Started

```
git clone https://github.com/ygout/agence.git
```

### Installation
```
cd agence
composer install
```
### Database

##### Create database and structure (table)
````
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
````
##### Populate database
````
php bin/console doctrine:fixtures:load
````
### Run server

Don't forget to configure your .env at the root
````
DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name
````
Starting the server
````
php bin/console server:run
````

## Documentation

Symfony: https://symfony.com/doc
