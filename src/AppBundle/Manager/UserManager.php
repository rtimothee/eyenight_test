<?php

namespace AppBundle\Manager;


use AppBundle\Model\User;
use AppBundle\Utils\ParseHelper;
use Symfony\Component\Config\Definition\Exception\Exception;

class UserManager implements UserManagerInterface
{
    protected $parse;

    public function __construct(ParseHelper $parse)
    {
        $this->parse = $parse;
    }

    public function save(User $user)
    {
        return $this->parse->signUp($user->getLogin(), md5($user->getPassword()), $user->getEmail());
    }


    public function login(User $user)
    {
        return $this->parse->login($user->getLogin(), md5($user->getPassword()));
    }

    public function isLogged()
    {
        return (null !== $this->parse->getCurrentUser());
    }

    public function logout()
    {
        $this->parse->logout();
    }

    public function getCurrent()
    {
        dump($this->parse->getInfos()); // TODO : A supprimer
        $current = $this->parse->getCurrentUser();

        if (null !== $current) {
            $user = new User($this);
            $user->setEmail($current["email"]);
            $user->setlogin($current["login"]);
            $user->setToken($current["token"]);

            return $user;
        }

        return null;
    }

    public function removeCurrentUser()
    {
        $this->parse->removeUser();
    }
}