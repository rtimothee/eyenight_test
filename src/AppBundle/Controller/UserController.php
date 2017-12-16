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

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            try {
                $user->save();
                return $this->redirectToRoute('profil');
            } catch (\Exception $e) {
                $session = new Session();
                $session->getFlashBag()->add(
                    'error',
                    $e->getMessage()
                );
            }
        }

        return $this->render('user/register.html.twig', [
            "form" => $form->createView()
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

            try {
                $user->login();
                return $this->redirectToRoute('profil');
            } catch (\Exception $e) {
                $session = new Session();
                $session->getFlashBag()->add(
                    'error',
                    $e->getMessage()
                );
            }

            return $this->redirectToRoute('profil');
        }

        return $this->render('user/login.html.twig', [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/profil", name="profil")
     */
    public function profilAction()
    {
        $userManager = $this->get('app.manager.user');
        $user = $userManager->getCurrent();
        if (null === $user) {
            return $this->redirectToRoute('login');
        }

        return $this->render('user/profil.html.twig', [
            "user" => $user
        ]);
    }

    /**
     * @Route("/delete", name="delete_user")
     */
    public function removeAction()
    {
        $userManager = $this->get('app.manager.user');
        $user = $userManager->getCurrent();
        if (null === $user) {
            return $this->redirectToRoute('login');
        }

        try {
            $userManager->removeCurrentUser();
        } catch (\Exception $e) {
            dump($e->getMessage());
            dump($e->getTrace());
            die();
        }

        return $this->redirectToRoute('register');
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {
        $userManager = $this->get('app.manager.user');
        $user = $userManager->getCurrent();

        if (null !== $user) {
            $userManager->logout();
        }

        return $this->redirectToRoute('login');
    }
}