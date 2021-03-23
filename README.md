<img align="left" src="https://github.com/foxsys-xyz/foxsys-xyz/blob/master/public/img/foxsys-xyz%20%5BIcon%5D%20%5BLight%20Back%5D.png" width="152" />

<br/><br/><br/><br/><br/><br/>

## foxsys-xyz \\ foxsys-xyz
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
