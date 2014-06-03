<?php

namespace Hive\Control;

use Hive\Api\Api;

class Devices
{
    private $api;

    public function __construct(Api $api)
    {
        $this->api = $api;
    }

    /**
     * Returns device list linked to hub
     *
     * @param $hubId - Hub ID to list devices for
     *
     * @return bool
     */
    public function getDeviceList($hubId = null)
    {
        if ($hubId == null) $hubId = $this->api->getHubId();
        return $this->api->sendRequest('get', '/users/'.$this->api->getUsername().'/hubs/'.$hubId.'/devices');
    }
}