# React Symfony Example App

A small web application written in PHP Symfony and React to manage a simple CRUD list of users.

## Project Setup

### REST API

Requires PHP >8 and Composer (https://getcomposer.org).

- `cd react-symfony-example/rest-api`
- `composer install`
- `php bin/console doctrine:migrations:migrate`
- `./start-local.sh`

### React App

Requires Node (https://nodejs.org). Yarn (https://yarnpkg.com) recommended for installing and managing dependencies.

- `cd react-symfony-example/react-app`
- `yarn install`
- `yarn start`
