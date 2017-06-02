<?php

namespace DrAdminBundle\Controller;

use DrAdminBundle\Entity\SocialNetwork;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Socialnetwork controller.
 *
 */
class SocialNetworkController extends Controller
{
    /**
     * Lists all socialNetwork entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $socialNetworks = $em->getRepository('DrAdminBundle:SocialNetwork')->findAll();

        return $this->render('DrAdminBundle:socialnetwork:index.html.twig', array(
            'socialNetworks' => $socialNetworks,
        ));
    }

    /**
     * Creates a new socialNetwork entity.
     *
     */
    public function newAction(Request $request)
    {
        $socialNetwork = new Socialnetwork();
        $form = $this->createForm('DrAdminBundle\Form\SocialNetworkType', $socialNetwork);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($socialNetwork);
            $em->flush($socialNetwork);

            return $this->redirectToRoute('socialnetwork_show', array('id' => $socialNetwork->getId()));
        }

        return $this->render('DrAdminBundle:socialnetwork:new.html.twig', array(
            'socialNetwork' => $socialNetwork,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a socialNetwork entity.
     *
     */
    public function showAction(SocialNetwork $socialNetwork)
    {
        $deleteForm = $this->createDeleteForm($socialNetwork);

        return $this->render('DrAdminBundle:socialnetwork:show.html.twig', array(
            'socialNetwork' => $socialNetwork,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing socialNetwork entity.
     *
     */
    public function editAction(Request $request, SocialNetwork $socialNetwork)
    {
        $deleteForm = $this->createDeleteForm($socialNetwork);
        $editForm = $this->createForm('DrAdminBundle\Form\SocialNetworkType', $socialNetwork);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('socialnetwork_edit', array('id' => $socialNetwork->getId()));
        }

        return $this->render('DrAdminBundle:socialnetwork:edit.html.twig', array(
            'socialNetwork' => $socialNetwork,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a socialNetwork entity.
     *
     */
    public function deleteAction(Request $request, SocialNetwork $socialNetwork)
    {
        $form = $this->createDeleteForm($socialNetwork);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($socialNetwork);
            $em->flush($socialNetwork);
        }

        return $this->redirectToRoute('socialnetwork_index');
    }

    /**
     * Creates a form to delete a socialNetwork entity.
     *
     * @param SocialNetwork $socialNetwork The socialNetwork entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SocialNetwork $socialNetwork)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('socialnetwork_delete', array('id' => $socialNetwork->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
