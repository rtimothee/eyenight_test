<?php
namespace AppBundle\EventSubscriber;

use AppBundle\Exception\NeedLoginRedirectException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\Routing\Router;

class ExceptionListener
{

    protected $router;
    protected $session;

    public function __construct(Router $router, Session $session)
    {
        $this->router = $router;
        $this->session = $session;
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        if (!($exception instanceof NeedLoginRedirectException)) {
            return;
        }

        $this->session->getFlashBag()->add('error', 'You need to be logged for this page');
        $url = $this->router->generate('login');
        $response = new RedirectResponse($url);
        $event->setResponse($response);

    }
}