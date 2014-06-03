<?php

namespace Hive\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;

Class Api
{
    private $username;
    private $password;
    private $url;
    private $caller = 'PHP Hive API';
    private $cookieJar;
    private $logged_in = false;
    private $hubs;

    /**
     * @param               $username - Your Hive API Username
     * @param               $password - Your Hive API Password
     * @param        string $url      - URL of API EndPoint
     */
    public function __construct($username, $password, $url = 'https://api.bgchlivehome.co.uk/v5')
    {
        $this->setUsername($username);
        $this->setPassword($password);
        $this->setUrl($url);
    }

    public function sendRequest($method = 'get', $location, $params = array())
    {
        if (!$this->logged_in && $location != '/login') {
            $response = $this->sendRequest('post', '/login');
            $this->logged_in = true;
            $this->hubs = $response['hubIds'];
        }
        $params = array_merge(
            [
                'username' => $this->username,
                'password' => $this->password,
                'caller'   => $this->caller
            ], $params
        );

        $oClient = new Client();
        $response = $oClient->$method(
            $this->url . $location, [
                'body'    => $params,
                'cookies' => $this->getCookieJar()
            ]
        );
        if ($method == 'put') {
            if ($response->getStatusCode() == 204) {
                return true;
            } else {
                throw new Exception('Unable to perform action to '.$location);
            }
        }
        $data = $response->json();
        if (isset($data['error']) && $data['error'] != '') {
            throw new Exception($data['error']);
        }
        return $data;
    }

    /**
     * Gets cookie jar to be used in request
     *
     * @return CookieJar
     */
    private function getCookieJar()
    {
        if (!$this->cookieJar) {
            $this->cookieJar = new CookieJar();
        }
        return $this->cookieJar;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }


}