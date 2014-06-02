Hive Control
============

This repository provides the ability to interact with a RESTful API provided by British Gas to control your Hive home heating system. (http://www.hivehome.com)

Note: This API is in no way endorsed by British Gas, and is subject to change at any time.

The API Credentials are the same as used to login to the web interface to manage your Hive.

Sample Code
-----------
Get Current Temperature
```php
<?php
$api = new \Hive\Api\Api('<username>', '<password>')
$status = new \Hive\Control\Status($api);
echo $status->getCurrentTemperature();
```

Set Target Temperature
```php
<?php
$api = new \Hive\Api\Api('<username>', '<password>');
$temperature = new \Hive\Control\Temperature($api);
$temperature->setTargetTemperature(20);
```

Currently I can't re-engineer the methods to set the heating schedule but, its something I'm working on.

This is most definitely a work in progress