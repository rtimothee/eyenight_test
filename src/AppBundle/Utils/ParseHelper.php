<?php

namespace AppBundle\Utils;


use Parse\ParseClient;
use Parse\ParseException;
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseSchema;
use Parse\ParseUser;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ParseHelper
{
    protected $container;

    protected $app_id;
    protected $master_key;
    protected $host;

    /**
     * ParseHelper constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

        $this->app_id = $this->container->getParameter('parse_app_id');
        $this->master_key = $this->container->getParameter('parse_client_key');
        $this->host = $this->container->getParameter('parse_host');

        $this->initialize();

        return $this;
    }

    /**
     * Initialize Parse SDK
     */
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


    /**
     * @param $login
     * @param $password
     * @return array|null
     */
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

    /**
     * @param $login
     * @param $password
     * @param $email
     * @return array|null
     */
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

    /**
     * Logout the current User
     */
    public function logout()
    {
        ParseUser::logOut();
    }

    /**
     * @return array|null
     */
    public function getCurrentUser()
    {
        return $this->serializedUser(ParseUser::getCurrentUser());
    }

    /**
     * Remove the Current User
     */
    public function removeUser()
    {
        $user = ParseUser::getCurrentUser();
        if (null !== $user) {
            $user->destroy(true);
        } else {
            throw new Exception("Parse: Unauthorized Action", 209);
        }
    }

    /**
     * @param $objectName
     * @param $nb
     * @return ParseObject[]
     */
    public function getAll($objectName, $nb)
    {
        $query = new ParseQuery($objectName);
        try {
            $query->limit($nb);
            return $query->find();
        } catch (ParseException $ex) {
            if (209 === $ex->getCode()) {
                throw new Exception("Parse: User Unauthorized", 209);
            } else {
                throw new Exception("Parse: Get object fail", 500);
            }
        }

    }

    /**
     * @param $objectName
     * @param $objectId
     * @return array|ParseObject
     */
    public function get($objectName, $objectId)
    {
        $query = new ParseQuery($objectName);
        try {
            $object = $query->get($objectId);
            return $object;
        } catch (ParseException $ex) {
            throw new Exception("Parse: Get object fail", 500);
        }
    }

    /**
     * @param $objectName
     * @param $searchObjectName
     * @param $searchObjectId
     * @return ParseObject[]
     */
    public function getLinkedObjects($objectName, $searchObjectName, $searchObjectId)
    {
        $query = new ParseQuery($objectName);
        $query->equalTo(strtolower($searchObjectName), new ParseObject($searchObjectName, $searchObjectId));
        return $query->find();
    }


    /**
     * @param $user
     * @return array|null
     */
    private function serializedUser($user)
    {
        return (null !== $user) ? [
            "email" => $user->getEmail(),
            "login" => $user->getUsername(),
            "token" => $user->getSessionToken()
        ] : null;
    }


}