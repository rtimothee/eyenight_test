<?php

namespace AppBundle\Model;


use AppBundle\Manager\UserManagerInterface;

class User
{

    protected $login;
    protected $password;
    protected $email;
    protected $token;

    private $userManager;


    public function __construct(UserManagerInterface $um)
    {
        $this->userManager = $um;
    }


    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed string
     */
    public function setToken($token)
    {
        $this->token = $token;
    }


    /**
     * Save
     */
    public function save()
    {
        $this->userManager->save($this);
    }

    /**
     * Login
     */
    public function login()
    {
        $this->userManager->login($this);
    }

}