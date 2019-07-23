<h1>Spider coupons of markets</h1>
Project "Spider coupons of market" created by <a href="https://github.com/yiisoft" target="_blank">"Yii 2 Basic Project Template"</a>

Additional libraries:
<a href="https://github.com/Imangazaliev/DiDOM" target="_blank">DiDOM - simple and fast HTML parser</a>
<a href="https://github.com/newerton/yii2-fancybox" target="_blank">yii2-fancybox</a>

REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.

DIRECTORY STRUCTURE
-------------------

    assets/         contains assets definition
    commands/       contains console commands (controllers)
    config/         contains application configurations
    controllers/    contains Web controller classes
    mail/           contains view files for e-mails
    models/         contains model classes
    runtime/        contains files generated during runtime
    tests/          contains various tests for the basic application
    vendor/         contains dependent 3rd-party packages
    views/          contains view files for the Web application
    web/            contains the entry script and Web resources

CONFIGURATION
------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];

```
For create tables `markets` and `coupons` you can:

- upload dump database.sql to database

or

- run migrate for create tables `markets` and `coupons`

(file migration: migrations/m190723_111254_create_markets_and_coupons_tables.php)

### Cookie

Set cookie validation key in `config/web.php` file to some random secret string:

```php
'request' => [
    // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
    'cookieValidationKey' => '<secret random string goes here>',
],
```

### Access to website

Edit the file `model/User.php` with real data, for example:
```php
private static $users = [
    '100' => [
        'id'          => '100',
        'username'    => 'admin',
        'password'    => '',
        'authKey'     => 'test100key',
        'accessToken' => '100-token',
    ],
];
```

### Cron

file console command ../commands/SpiderController.php

run by cron:

0	5	*	*	* /usr/local/bin/php /path/yii spider/get-coupons >/dev/null 2>&1

Replace 'path' with your

### Debug

file ../web/index.php

Comment out the following two lines when deployed to production:
```php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
```
