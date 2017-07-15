<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ApiToken;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Apitoken controller.
 *
 * @Route("apitoken")
 */
class ApiTokenController extends Controller
{
    /**
     * Lists all apiToken entities.
     *
     * @Route("/", name="apitoken_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $apiTokens = $em->getRepository('AppBundle:ApiToken')->findAll();

        return $this->render('apitoken/index.html.twig', array(
            'apiTokens' => $apiTokens,
        ));
    }

    /**
     * Creates a new apiToken entity.
     *
     * @Route("/new", name="apitoken_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $apiToken = new Apitoken();
        $form = $this->createForm('AppBundle\Form\ApiTokenType', $apiToken);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($apiToken);
            $em->flush();

            return $this->redirectToRoute('apitoken_show', array('id' => $apiToken->getId()));
        }

        return $this->render('apitoken/new.html.twig', array(
            'apiToken' => $apiToken,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a apiToken entity.
     *
     * @Route("/{id}", name="apitoken_show")
     * @Method("GET")
     */
    public function showAction(ApiToken $apiToken)
    {
        $deleteForm = $this->createDeleteForm($apiToken);

        return $this->render('apitoken/show.html.twig', array(
            'apiToken' => $apiToken,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing apiToken entity.
     *
     * @Route("/{id}/edit", name="apitoken_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ApiToken $apiToken)
    {
        $deleteForm = $this->createDeleteForm($apiToken);
        $editForm = $this->createForm('AppBundle\Form\ApiTokenType', $apiToken);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('apitoken_edit', array('id' => $apiToken->getId()));
        }

        return $this->render('apitoken/edit.html.twig', array(
            'apiToken' => $apiToken,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a apiToken entity.
     *
     * @Route("/{id}", name="apitoken_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ApiToken $apiToken)
    {
        $form = $this->createDeleteForm($apiToken);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($apiToken);
            $em->flush();
        }

        return $this->redirectToRoute('apitoken_index');
    }

    /**
     * Creates a form to delete a apiToken entity.
     *
     * @param ApiToken $apiToken The apiToken entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ApiToken $apiToken)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('apitoken_delete', array('id' => $apiToken->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
