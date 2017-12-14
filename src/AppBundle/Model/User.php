<?php

namespace AppBundle\Model;


use AppBundle\Manager\UserManagerInterface;

class User
{

    protected $login;
    protected $password;
    protected $email;

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

    public function save()
    {
        $this->userManager->save($this);
    }

    public function login()
    {
        $this->userManager->login($this);
    }
}