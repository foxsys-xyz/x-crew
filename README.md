<img align="left" src="https://github.com/foxsys-xyz/foxsys-xyz/blob/master/public/img/FOXSYS%20%5BXYZ%5D%20Logo%20%5BBlack%5D.png" width="256">

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

This repository is private and for rightly use by only foxsys-xyz. Any member or contributor will not be using this for distribution & selling purposes.
