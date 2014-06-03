<?php

namespace Hive\Control;

use Hive\Api\Api;

class Cost
{
    private $api;

    public function __construct(Api $api)
    {
        $this->api = $api;
    }

    public function getCostOverview()
    {
        return $this->api->sendRequest('get', '/users/'.$this->api->getUsername().'/widgets/usage/cost');
    }
}