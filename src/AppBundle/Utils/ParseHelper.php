<?php

namespace AppBundle\Utils;


use Parse\ParseClient;
use Parse\ParseException;
use Parse\ParseUser;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ParseHelper
{
    protected $container;

    protected $app_id;
    protected $master_key;
    protected $host;

    /*    protected $login;
        protected $password;*/

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

        $this->app_id = $this->container->getParameter('parse_app_id');
        $this->master_key = $this->container->getParameter('parse_client_key');
        $this->host = $this->container->getParameter('parse_host');
        /*$this->login = $this->container->getParameter('parse_login');
        $this->password = $this->container->getParameter('parse_password');*/

        $this->initialize();

        return $this;
    }

    public function initialize()
    {
        try {
            ParseClient::initialize($this->app_id, null, $this->master_key);
            ParseClient::setServerURL($this->host, 'parse');
            ParseUser::logOut();

            $health = ParseClient::getServerHealth();
            if (200 !== $health["status"]) {
                throw new Exception("Parse: invalid initialization", 500);
            }
        } catch (\Exception $e) {
            dump($e->getMessage());
            throw new Exception("Parse: invalid initialization", 500);
        }
    }

    public function login($login, $password)
    {
        $user = ParseUser::getCurrentUser();
        if (null === $user) {
            try {
                $user = ParseUser::logIn($login, $password);
            } catch (ParseException $error) {
                dump($error->getMessage());
                dump($error->getTraceAsString());
                throw new Exception("Parse: login failed", 500);
            }
        }

        return $this->serializedUser($user);
    }

    public function signUp($login, $password, $email)
    {

        $user = new ParseUser();
        $user->setUsername($login);
        $user->setPassword($password);
        $user->setEmail($email);

        try {
            $user->signUp();
        } catch (ParseException $ex) {
            dump($ex->getMessage());
            dump($ex->getTraceAsString());
            throw new Exception("Parse: Register failed", 500);
        }

        return $this->serializedUser($user);
    }

    public function logout()
    {
        ParseUser::logOut();
    }


    public function query()
    {
        /*
        $query = new ParseQuery("TestObject");
        $object = $query->get("anObjectId");
        $query->limit(10); // default 100, max 1000
        $results = $query->find();
        */
    }

    public function removeUser(){
        $user = ParseUser::getCurrentUser();
        $user->destroy();
    }

    private function serializedUser(ParseUser $user)
    {
        return [
            "email" => $user->getEmail(),
            "login" => $user->getUsername(),
            "token" => $user->getSessionToken()
        ];
    }



}