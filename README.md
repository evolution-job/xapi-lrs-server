LRS Server
==========

This implementation of a Symfony bundle 'php-xapi/lrs-bundle' generates a Learning Record Store, as defined by the xAPI (or Tin Can API).

The configuration guide proposed below uses **Doctrine** ORM.

Docker-compose build containers:
- PHP
- MySql
- Nginx

Local Installation
------------------

- Docker installation is readable here: [.docker\README.md](.docker/README.md)
- Put your DB credentials into a local unversioned file called `.env.local`
- In `.docker\` directory, run command `docker-compose up -d`
- Log in to PHP docker's container with command `docker exec -u webapp -ti lrs_php bash`
  - Download required packages with command `composer install`
  - Create your **database** with command `php bin/console doctrine:database:create -e dev`
  - Create **schema** with command `php bin/console doctrine:schema:create -e dev`
  - Warm up the cache with command `php bin/console cache:clear -e dev`

Local Endpoints
---------------

- https://lrs.entrili.local:444/lrs/activities
- https://lrs.entrili.local:444/lrs/activities/state
- https://lrs.entrili.local:444/lrs/statements
