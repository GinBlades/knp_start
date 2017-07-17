<?php

namespace AppBundle\Controller\Web;

use AppBundle\Controller\BaseController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class BattleController extends BaseController
{
    /**
     * @Route("/battles/new", name="battle_new")
     * @Method("POST")
     */
    public function newAction(Request $request)
    {
        $programmerId = $request->request->get('programmer_id');
        $projectId = $request->request->get('project_id');
        $programmer = $this->getProgrammerRepository()->find($programmerId);
        $project = $this->getProjectRepository()->find($projectId);

        if ($programmer->getUser() != $this->getUser()) {
            throw new AccessDeniedException();
        }

        $battle = $this->getBattleManager()->battle($programmer, $project);
        return $this->redirect($this->generateUrl('battle_show', ['id' => $battle->getId()]));
    }

    /**
     * @Route("/battles/{id}", name="battle_show")
     * @Method("GET")
     */
    public function showAcation($id)
    {
        $battle = $this->getBattleRepository()->find($id);

        return $this->render('battle/show.twig', [
            'battle' => $battle,
            'programmer' => $battle->getProgrammer(),
            'project' => $battle->getProject()
        ]);
    }

    /**
     * @Route("/battles", name="battle_list")
     */
    public function listAction()
    {
        $battles = $this->getBattleRepository()->findAll();

        return $this->render('battle/list.twig', [
            'battles' => $battles
        ]);
    }
}
