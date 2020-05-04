<?php


namespace App\Application\Command\Astronaut;


class AddAstronautCommand
{
    public $username;
    public $password;
    public $apiToken;

    /**
     * AddAstronautCommand constructor.
     * @param $username
     * @param $password
     * @param $apiToken
     */
    public function __construct($username = null, $password = null, $apiToken = null)
    {
        $this->username = $username;
        $this->password = $password;
        $this->apiToken = $apiToken;
    }

    /**
     * @return null
     */
    public function getApiToken()
    {
        return $this->apiToken;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

}