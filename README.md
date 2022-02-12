##PP Challenge

###Requirements
- Docker
- PHP 8.0+
- Composer

###Installation
- Once the repo is cloned, copy the `.env.example` as `.env` into the root directory
- Add `APP_PORT` and `FORWARD_DB_PORT` values as required if clashes with system ports, By default this project will run on port localhost:80
- Run `composer install`
- Run `./vendor/bin/sail up` to build the containers
- Run `./vendor/bin/sail test` to perform tests


