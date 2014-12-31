# manivo

[![Deploy](https://www.herokucdn.com/deploy/button.png)](https://heroku.com/deploy)

Now under developing.

## Requirements

* PHP 5.5+

## Getting started

Push `Deploy to Heroku` button, or:

```bash
$ git clone git@github.com:qckanemoto/manivo.git
$ cd manivo
$ composer install
$ cp var/conf/parse.php.placeholder var/conf/parse.php
$ vi var/conf/parse.php  # tailor to your Parse.com app.
```

## Usage

```bash
$ php bootstrap/api.php get "app://self/users"
```
