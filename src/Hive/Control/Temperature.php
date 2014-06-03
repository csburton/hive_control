<?php

namespace Hive\Control;


use Hive\Api\Api;

class Temperature
{
    private $api;

    public function __construct(Api $api)
    {
        $this->api = $api;
    }

    /**
     * Sets the target temperature for the boiler to try to reach
     *
     * @param float $temperature - Temperature to set
     *
     * @return array - Response of request (This returns NULL on success for some reason)
     */
    public function setTargetTemperature($temperature)
    {
        return $this->api->sendRequest(
            'put', '/users/' . $this->api->getUsername() . '/widgets/heating/targetTemperature',
            ['temperature' => $temperature]
        );
    }

    /**
     * Gets the current temperature in the target household as reported by the thermostat
     *
     * @return float - Current Temperature
     */
    public function getCurrentTemperature()
    {
        $response = $this->api->sendRequest('get', '/users/' . $this->api->getUsername() . '/widgets/heating');
        return $response['currentTemperature'];
    }

    /**
     * Gets the current temperature that the boiler is trying to reach
     *
     * @return float - Target Temperature
     */
    public function getCurrentTargetTemperature()
    {
        $response = $this->api->sendRequest('get', '/users/' . $this->api->getUsername() . '/widgets/heating');
        return $response['targetTemperature'];
    }


    /**
     * Gets the current heating mode
     *
     * @return mixed - Return Types: AUTO, OFF, MANUAL
     */
    public function getHeatingMode()
    {
        $response = $this->api->sendRequest('get', '/users/' . $this->api->getUsername() . '/widgets/heating');
        return $response['mode'];
    }


    /**
     * Sets the current heating mode to be used by Hive (AUTO, MANUAL OR OFF)
     *
     * @param $mode - Mode To set temperature setting
     *
     * @return boolean
     * @throws Exception - If invalid mode is passed
     */
    public function setHeatingMode($mode)
    {
        if (!in_array($mode, ['AUTO', 'OFF', 'MANUAL'])) {
            throw new Exception($mode.' is an invalid heating mode');
        }
        return $this->api->sendRequest(
            'put', '/users/' . $this->api->getUsername() . '/widgets/heating/mode',
            ['mode' => $mode]
        );
    }

    /**
     * Gets current heating schedule
     *
     * @return array
     */
    public function getSchedule() {
        return $this->api->sendRequest('get', '/users/'.$this->api->getUsername().'/widgets/heating/detail');
    }


    /**
     * Sets the current heating schedule
     *
     * @throws Exception
     */
    public function setSchedule($schedule) {
        /* @todo: implement this method */
        throw new Exception('Method setSchedule is not yet implemented');
    }
}