<?php


namespace App\Application\Command\Astronaut;


use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AddAstronautCommand
{
    public $username;
    public $password;
    public $userPasswordEncoder;
    public $apiToken;

    /**
     * AddAstronautCommand constructor.
     * @param null $username
     * @param null $password
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     */
    public function __construct($username, $password, UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->username = $username;
        $this->password = $password;
        $this->userPasswordEncoder = $userPasswordEncoder;
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