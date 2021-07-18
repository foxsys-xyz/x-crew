<br/><br/>

<img align="left" src="./public/img/Logo [Dark Background].svg" width="64" />

<br/><br/><br/><br/>

## foxsys-xyz \\ x-crew
The main foxsys-xyz application. Still a work in progress.

## Installation

This application requires just laravel & php 7.3 for a build as minimum. Obviously, you should have composer & yarn or npm installed for the node dependencies.

Install the dependencies and devDependencies and start the server.

```sh
$ cd foxsys-xyz
$ composer install && yarn install && yarn run dev
$ cp .env.example .env && php artisan key:generate
$ php artisan serve
```

For production environments.

```sh
$ yarn run production
```
