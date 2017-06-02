<?php

namespace DrAdminBundle\Controller;

use DrAdminBundle\Entity\Technology;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Technology controller.
 *
 */
class TechnologyController extends Controller
{
    /**
     * Lists all technology entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $technologies = $em->getRepository('DrAdminBundle:Technology')->findAll();

        return $this->render('DrAdminBundle:technology:index.html.twig', array(
            'technologies' => $technologies,
        ));
    }

    /**
     * Creates a new technology entity.
     *
     */
    public function newAction(Request $request)
    {
        $technology = new Technology();
        $form = $this->createForm('DrAdminBundle\Form\TechnologyType', $technology);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($technology);
            $em->flush($technology);

            return $this->redirectToRoute('technology_show', array('id' => $technology->getId()));
        }

        return $this->render('DrAdminBundle:technology:new.html.twig', array(
            'technology' => $technology,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a technology entity.
     *
     */
    public function showAction(Technology $technology)
    {
        $deleteForm = $this->createDeleteForm($technology);

        return $this->render('DrAdminBundle:technology:show.html.twig', array(
            'technology' => $technology,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing technology entity.
     *
     */
    public function editAction(Request $request, Technology $technology)
    {
        $deleteForm = $this->createDeleteForm($technology);
        $editForm = $this->createForm('DrAdminBundle\Form\TechnologyType', $technology);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('technology_edit', array('id' => $technology->getId()));
        }

        return $this->render('DrAdminBundle:technology:edit.html.twig', array(
            'technology' => $technology,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a technology entity.
     *
     */
    public function deleteAction(Request $request, Technology $technology)
    {
        $form = $this->createDeleteForm($technology);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($technology);
            $em->flush($technology);
        }

        return $this->redirectToRoute('technology_index');
    }

    /**
     * Creates a form to delete a technology entity.
     *
     * @param Technology $technology The technology entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Technology $technology)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('technology_delete', array('id' => $technology->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
