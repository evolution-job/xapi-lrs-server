LRS Server
==========

This implementation of Symfony bundle 'php-xapi/lrs-bundle' generate a Learning Record Store, as defined by the xAPI (or Tin Can API).

The configuration guide proposed below is use **Doctrine** ORM.

Docker compose build containers
- PHP
- MySql
- Nginx

Versions
------------
- V1.0: Original packages + some additions - PHP 7.1 & Symfony 4.3

Installation
------------
- launch `composer install -W` to download required libraries
- put your DB credentials into a local `.env.local` file
- Update your **database** with command `php bin/console doctrine:migrations:migrate`

Endpoints
---------
- /lrs/activity
- /lrs/activity/state
- /lrs/statements
