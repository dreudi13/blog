<?php

namespace DrAdminBundle\Controller;

use DrAdminBundle\Entity\Skill;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Skill controller.
 *
 */
class SkillController extends Controller
{
    /**
     * Lists all skill entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $skills = $em->getRepository('DrAdminBundle:Skill')->findAll();

        return $this->render('DrAdminBundle:skill:index.html.twig', array(
            'skills' => $skills,
        ));
    }

    /**
     * Creates a new skill entity.
     *
     */
    public function newAction(Request $request)
    {
        $skill = new Skill();
        $form = $this->createForm('DrAdminBundle\Form\SkillType', $skill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($skill);
            $em->flush($skill);

            return $this->redirectToRoute('skill_show', array('id' => $skill->getId()));
        }

        return $this->render('DrAdminBundle:skill:new.html.twig', array(
            'skill' => $skill,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a skill entity.
     *
     */
    public function showAction(Skill $skill)
    {
        $deleteForm = $this->createDeleteForm($skill);

        return $this->render('DrAdminBundle:skill:show.html.twig', array(
            'skill' => $skill,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing skill entity.
     *
     */
    public function editAction(Request $request, Skill $skill)
    {
        $deleteForm = $this->createDeleteForm($skill);
        $editForm = $this->createForm('DrAdminBundle\Form\SkillType', $skill);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('skill_edit', array('id' => $skill->getId()));
        }

        return $this->render('DrAdminBundle:skill:edit.html.twig', array(
            'skill' => $skill,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a skill entity.
     *
     */
    public function deleteAction(Request $request, Skill $skill)
    {
        $form = $this->createDeleteForm($skill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($skill);
            $em->flush($skill);
        }

        return $this->redirectToRoute('skill_index');
    }

    /**
     * Creates a form to delete a skill entity.
     *
     * @param Skill $skill The skill entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Skill $skill)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('skill_delete', array('id' => $skill->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
