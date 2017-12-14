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
            $this->parse->signUp($user->getLogin(), md5($user->getPassword()), $user->getEmail());
    }


    public function login(User $user)
    {
        $this->parse->login($user->getLogin(), md5($user->getPassword()));
    }
}