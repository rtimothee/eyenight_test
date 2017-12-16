<?php

namespace AppBundle\Utils;


use Parse\ParseClient;
use Parse\ParseException;
use Parse\ParseSchema;
use Parse\ParseServerInfo;
use Parse\ParseUser;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ParseHelper
{
    protected $container;

    protected $app_id;
    protected $master_key;
    protected $host;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

        $this->app_id = $this->container->getParameter('parse_app_id');
        $this->master_key = $this->container->getParameter('parse_client_key');
        $this->host = $this->container->getParameter('parse_host');

        $this->initialize();

        return $this;
    }

    public function initialize()
    {
        try {
            ParseClient::initialize($this->app_id, null, $this->master_key);
            ParseClient::setServerURL($this->host, 'parse');

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
                if (101 === $error->getCode()) {
                    throw new Exception("Parse: Invalid login/password", 500);
                } else {
                    throw new Exception("Parse: login failed", 500);
                }

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
            throw new Exception("Parse: Register failed", 500);
        }

        return $this->serializedUser($user);
    }

    public function logout()
    {
        ParseUser::logOut();
    }

    public function getCurrentUser()
    {
        return $this->serializedUser(ParseUser::getCurrentUser());
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

    public function removeUser()
    {
        $user = ParseUser::getCurrentUser();
        if (null !== $user) {
            $user->destroy(true);
        } else {
            throw new Exception("Parse: Unauthorized Action", 500);
        }
    }

    public function getInfos() // TODO : A supprimer
    {
        $schema = new ParseSchema();
        return $schema->all();
    }

    private function serializedUser($user)
    {
        return (null !== $user) ? [
            "email" => $user->getEmail(),
            "login" => $user->getUsername(),
            "token" => $user->getSessionToken()
        ] : null;
    }


}