<?php

namespace AppBundle\Manager;

use AppBundle\Model\User;

interface UserManagerInterface
{
    public function save(User $user);
    public function login(User $user);
}