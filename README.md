# manivo

[![Deploy](https://www.herokucdn.com/deploy/button.png)](https://heroku.com/deploy)

Now under developing.

## Requirements

* PHP 5.4+

## Getting started

```bash
$ git clone git@github.com:qckanemoto/manivo-api.git
$ cd manivo-api
$ composer install
$ cp var/conf/parse.php.placeholder var/conf/parse.php
$ vi var/conf/parse.php  # tailor to your Parse.com app.
```

## Usage

```bash
$ php bootstrap/context/api.php get "app://self/users"
```
