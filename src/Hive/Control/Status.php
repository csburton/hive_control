<?php

namespace Hive\Control;


use Hive\Api\Api;

class Status
{
    private $api;
    protected $cache;

    public function __construct(Api $api)
    {
        $this->api = $api;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        if (!isset($this->cache['status'])) {
            $this->cache['status'] = $this->api->sendRequest(
                'get', '/users/' . $this->api->getUsername() . '/widgets/heating'
            );
        }
        return $this->cache['status'];
    }

    public function isBoilerOn()
    {
        $status = $this->getStatus();
        return $status['boilerOn'];
    }

    public function getCurrentHeatingMode()
    {
        $status = $this->getStatus();
        return $status['mode'];
    }
}