<?php

namespace Hive\Control;

use Hive\Api\Api;

class Users
{
    private $api;

    public function __construct(Api $api)
    {
        $this->api = $api;
    }

    public function getUserInfo()
    {
        return $this->api->sendRequest('get', '/users/'.$this->api->getUsername());
    }
}