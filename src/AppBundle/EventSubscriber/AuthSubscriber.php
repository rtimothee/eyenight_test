<?php

namespace AppBundle\EventSubscriber;

use AppBundle\Controller\AuthController;
use AppBundle\Exception\NeedLoginRedirectException;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;

class AuthSubscriber implements EventSubscriberInterface
{
    protected $container;
    protected $router;
    protected $session;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function onKernelController(FilterControllerEvent $event)
    {
        $controller = $event->getController();
        if (!is_array($controller)) {
            return;
        }

        if ($controller[0] instanceof AuthController) {
            $userManager = $this->container->get('app.manager.user');

            $user = $userManager->getCurrent();
            if (!$userManager->isLogged()) {
                throw new NeedLoginRedirectException("You must be logged in to see this page");
            }
        }
    }

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::CONTROLLER => 'onKernelController',
        );
    }
}