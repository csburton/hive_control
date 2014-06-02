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
$oApi = new \Hive\Api\Api('<username>', '<password>')
$oStatus = new \Hive\Control\Status($oApi);
echo $oStatus->getCurrentTemperature();
```

Set Target Temperature
```php
<?php
$oApi = new \Hive\Api\Api('<username>', '<password>');
$oTemperature = new \Hive\Control\Temperature($oApi);
$oTemperature->setTargetTemperature(20);
```
