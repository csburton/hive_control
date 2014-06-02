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
        $oStatus = new Status($this->api);
        $status = $oStatus->getStatus();
        return $status['currentTemperature'];
    }

    /**
     * Gets the current temperature that the boiler is trying to reach
     *
     * @return float - Target Temperature
     */
    public function getCurrentTargetTemperature()
    {
        $oStatus = new Status($this->api);
        $status = $oStatus->getStatus();
        return $status['targetTemperature'];
    }

}