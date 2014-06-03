<?php

namespace Hive\Control;

use Hive\Api\Api;

class Usage
{
    private $api;

    public function __construct(Api $api)
    {
        $this->api = $api;
    }

    /**
     * Gets current usage information
     *
     * @return array - Usage information
     */
    public function getUsageOverview()
    {
        return $this->api->sendRequest('get', '/users/'.$this->api->getUsername().'/widgets/usage/energy');
    }
}