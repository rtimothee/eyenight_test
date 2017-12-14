<?php


namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Session\Session;

use AppBundle\Model\User;
use AppBundle\Form\RegisterType;
use AppBundle\Form\LoginType;


/**
 * @Route("/user")
 */
class UserController extends Controller
{

    /**
     * @Route("/register", name="register")
     */
    public function registerAction(Request $request)
    {
        $userManager = $this->get('app.manager.user');
        $user = new User($userManager);
        $form = $this->createForm(RegisterType::class, $user);
        $error = "";

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            try{
                $user->save();

                //return $this->redirectToRoute('task_success');
            } catch(\Exception $e){
                $session = new Session();
                $session->start();
                $session->getFlashBag()->add(
                    'error',
                    $e->getMessage()
                );
            }


        }

        return $this->render('user/register.html.twig', [
            "form" => $form->createView(),
            "message_error" => $error
        ]);

    }


    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        $userManager = $this->get('app.manager.user');
        $user = new User($userManager);
        $form = $this->createForm(LoginType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $user->login();
            //return $this->redirectToRoute('task_success');
        }

        return $this->render('user/login.html.twig', [
            "form" => $form->createView()
        ]);

    }

}