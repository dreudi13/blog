<?php

namespace DrAdminBundle\Controller;

use DrAdminBundle\Entity\Experience;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Experience controller.
 *
 */
class ExperienceController extends Controller
{
    /**
     * Lists all experience entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $experiences = $em->getRepository('DrAdminBundle:Experience')->findAll();

        return $this->render('DrAdminBundle:experience:index.html.twig', array(
            'experiences' => $experiences,
        ));
    }

    /**
     * Creates a new experience entity.
     *
     */
    public function newAction(Request $request)
    {
        $experience = new Experience();
        $form = $this->createForm('DrAdminBundle\Form\ExperienceType', $experience);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($experience);
            $em->flush($experience);

            return $this->redirectToRoute('experience_show', array('id' => $experience->getId()));
        }

        return $this->render('DrAdminBundle:experience:new.html.twig', array(
            'experience' => $experience,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a experience entity.
     *
     */
    public function showAction(Experience $experience)
    {
        $deleteForm = $this->createDeleteForm($experience);

        return $this->render('DrAdminBundle:experience:show.html.twig', array(
            'experience' => $experience,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing experience entity.
     *
     */
    public function editAction(Request $request, Experience $experience)
    {
        $deleteForm = $this->createDeleteForm($experience);
        $editForm = $this->createForm('DrAdminBundle\Form\ExperienceType', $experience);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('experience_edit', array('id' => $experience->getId()));
        }

        return $this->render('DrAdminBundle:experience:edit.html.twig', array(
            'experience' => $experience,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a experience entity.
     *
     */
    public function deleteAction(Request $request, Experience $experience)
    {
        $form = $this->createDeleteForm($experience);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($experience);
            $em->flush($experience);
        }

        return $this->redirectToRoute('experience_index');
    }

    /**
     * Creates a form to delete a experience entity.
     *
     * @param Experience $experience The experience entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Experience $experience)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('experience_delete', array('id' => $experience->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
