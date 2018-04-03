<h1 align="center">
    <a href="http://travelsheets.quentinmachard.fr/" target="_blank">
        <img src="http://travelsheets.quentinmachard.fr/banner.png" />
    </a>
    <br />
    <a href="https://travis-ci.org/travelsheets/travelsheets-api" title="Build status" target="_blank">
        <img src="https://img.shields.io/travis/travelsheets/travelsheets-api/master.svg" />
    </a>
</h1>

# Documentation

Documentation is available at [https://travelsheets.docs.apiary.io/](https://travelsheets.docs.apiary.io/).

# Installation

## With Docker

* Clone the project

```sh
$ git clone git@github.com:travelsheets/travelsheets-api.git
$ cd travelsheets-api
```

* Create your environment settings and edit it

```sh
$ cd ./etc/docker
$ cp .env.dist .env
```

* Build and run the docker environement

```sh
$ docker-compose build
$ docker-compose up -d
```

* Update your system host file

```sh
$ sudo echo $(docker network inspect bridge | grep Gateway | grep -o -E '[0-9\.]+') "travelsheets.local" >> /etc/hosts
```

* Install the application

```sh
$ docker-compose exec php bash
$ ./etc/bash/install.sh
```

**Note:** `jwt_key_pass_phrase` is the pass phrase for JWT rsa key.

* Enjoy !

# Usage

Just run `docker-compose up -d`, then:

* Symfony app: visit travelsheets.local
* Symfony dev mode: visit travelsheets.local/app_dev.php
* Logs (files location): logs/nginx and logs/symfony

You can relaunch installation script to update the project.

# Useful commands

```sh
# bash commands
$ docker-compose exec php bash

# Composer (e.g. composer update)
$ docker-compose exec php composer update

# SF commands (Tips: there is an alias inside php container)
$ docker-compose exec php php /var/www/symfony/bin/console cache:clear
# Same command by using alias
$ docker-compose exec php bash
$ sf cache:clear

# Retrieve an IP Address (here for the nginx container)
$ docker inspect --format '{{ .NetworkSettings.Networks.dockersymfony_default.IPAddress }}' $(docker ps -f name=nginx -q)
$ docker inspect $(docker ps -f name=nginx -q) | grep IPAddress

# MySQL commands
$ docker-compose exec db mysql -uroot -p"root"

# F***ing cache/logs folder
$ sudo chmod -R 777 var/cache var/logs var/sessions

# Check CPU consumption
$ docker stats $(docker inspect -f "{{ .Name }}" $(docker ps -q))

# Delete all containers
$ docker rm $(docker ps -aq)

# Delete all images
$ docker rmi $(docker images -q)
```

# Contributing

First of all, thank you for contributing ♥
Also, while creating your Pull Request on GitHub, please write a description which gives the context and/or explains why you are creating it.

# Bug Tracking

If you want to report a bug or suggest an idea, please use [GitHub issues](https://github.com/travelsheets/travelsheets-api/issues).

# MIT License

TravelSheets is completely free and released under the [MIT License](https://github.com/travelsheets/travelsheets-api/blob/master/LICENSE).

# Authors

TravelSheets was originally created by [Quentin Machard](https://github.com/qmachard).
See the list of [contributors from our community](https://github.com/travelsheets/travelsheets-api/graphs/contributors).
