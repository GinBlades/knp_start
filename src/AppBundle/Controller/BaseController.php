<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

abstract class BaseController extends Controller
{
    public function isUserLoggedIn()
    {
        return $this->container->get('security.authorization_checker')
            ->isGranted('IS_AUTHENTICATED_FULLY');
    }

    public function loginUser(User $user)
    {
        $token = new UsernamePasswordToken($user, $user->getPassword(), 'main', $user->getRoles());
        $this->container->get('security.token_storage')->setToken($token);
    }

    public function addFlash($message, $positiveNotice = true)
    {
        $request = $this->container->get('request_stack')->getCurrentRequest();
        $noticeKey = $positiveNotice ? 'notice_happy' : 'notice_sad';

        $request->getSession()->getFlashbag()->add($noticeKey, $message);
    }

    public function findUserByUsername($username)
    {
        return $this->getUserRepository()->findUserByUsername($username);
    }

    protected function getUserRepository()
    {
        return $this->getDoctrine()->getRepository('AppBundle:User');
    }

    protected function getProgrammerRepository()
    {
        return $this->getDoctrine()->getRepository('AppBundle:Programmer');
    }

    protected function getProjectRepository()
    {
        return $this->getDoctrine()->getRepository('AppBundle:Project');
    }

    protected function getBattleRepository()
    {
        return $this->getDoctrine()->getRepository('AppBundle:Battle');
    }

    protected function getApiTokenRepository()
    {
        return $this->getDoctrine()->getRepository('AppBundle:ApiToken');
    }
}
