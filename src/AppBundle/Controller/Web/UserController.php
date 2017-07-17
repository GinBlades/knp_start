<?php

namespace AppBundle\Controller\Web;

use AppBundle\Controller\BaseController;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class UserController extends BaseController
{
    /**
     * @Route("/register", name="user_register")
     * @Method("GET")
     */
    public function registerAction()
    {
        if ($this->isUserLoggedIn()) {
            return $this->redirect($this->generateUrl('homepage'));
        }

        return $this->render('user/register.twig', ['user' => new User()]);
    }

    /**
     * @Route("/register", name="user_register_handle")
     * @Method("POST")
     */
    public function registerHandleAction(Request $request)
    {
        $errors = [];

        if (!$email = $request->request->get('email')) {
            $errors[] = '"email" is required';
        }
        if (!$plainPassword = $request->request->get('plainPassword')) {
            $errors[] = '"password" is required';
        }
        if (!$username = $request->request->get('username')) {
            $errors[] = '"username" is required';
        }

        $userRepository = $this->getUserRepository();

        // make sure we don't already have this user!
        if ($existingUser = $userRepository->findUserByEmail($email)) {
            $errors[] = 'A user with this email is already registered!';
        }

        // make sure we don't already have this user!
        if ($existingUser = $userRepository->findUserByUsername($username)) {
            $errors[] = 'A user with this username is already registered!';
        }

        $user = new User();
        $user->setEmail($email);
        $user->setUsername($username);
        $encodedPassword = $this->container->get('security.password_encoder')
            ->encodePassword($user, $plainPassword);
        $user->setPassword($encodedPassword);

        if (count($errors) > 0) {
            return $this->render('user/register.twig', ['errors' => $errors, 'user' => $user]);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        $this->loginUser($user);

        return $this->redirect($this->generateUrl('homepage'));
    }

    /**
     * @Route("/login", name="security_login_form")
     */
    public function loginAction(Request $request)
    {
        if ($this->isUserLoggedIn()) {
            return $this->redirect($this->generateUrl('homepage'));
        }

        return $this->render('user/login.twig', [
            'error' => $this->container->get('security.authentication_utils')->getLastAuthenticationError(),
            'last_username' => $this->container->get('security.authentication_utils')->getLastUserName()
        ]);
    }

    /**
     * @Route("/login_check", name="security_login_check")
     */
    public function loginCheckAction()
    {
        throw new \Exception('Should not get here, handled by security system.');
    }

    /**
     * @Route("/logout", name="security_logout")
     */
    public function logoutAction()
    {
        throw new \Exception('Should not get here, handled by security.');
    }
}