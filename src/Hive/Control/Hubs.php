<?php

namespace Hive\Control;

use Hive\Api\Api;

class Hubs
{
    private $api;

    public function __construct(Api $api)
    {
        $this->api = $api;
    }

    /**
     * Get all hubs currently linked to the logged in account
     *
     * @return array - Array of hubss
     */
    public function getHubs()
    {
        return $this->api->sendRequest('get', '/users/' . $this->api->getUsername() . '/hubs');
    }


    /**
     * Get information on a hub attached to the current account
     *
     * @param $hubId - String
     *
     * @return array - Response of hub info
     */
    public function getHubInfo($hubId)
    {
        return $this->api->sendRequest('get', '/users/' . $this->api->getUsername() . '/hubs/' . $hubId);
    }


    /**
     *
     *
     * @param $hubId
     *
     * @return mixed
     */
    public function getDevices($hubId)
    {
        return $this->api->sendRequest('get', '/users/' . $this->api->getUsername() . '/hubs/' . $hubId . '/devices');
    }
}