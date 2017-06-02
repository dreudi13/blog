<?php

namespace DrAdminBundle\Controller;

use DrAdminBundle\Entity\Info;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Info controller.
 *
 */
class InfoController extends Controller
{
    /**
     * Lists all info entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $infos = $em->getRepository('DrAdminBundle:Info')->findAll();

        return $this->render('DrAdminBundle:info:index.html.twig', array(
            'infos' => $infos,
        ));
    }

    /**
     * Creates a new info entity.
     *
     */
    public function newAction(Request $request)
    {
        $info = new Info();
        $form = $this->createForm('DrAdminBundle\Form\InfoType', $info);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($info);
            $em->flush($info);

            return $this->redirectToRoute('info_show', array('id' => $info->getId()));
        }

        return $this->render('DrAdminBundle:info:new.html.twig', array(
            'info' => $info,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a info entity.
     *
     */
    public function showAction(Info $info)
    {
        $deleteForm = $this->createDeleteForm($info);

        return $this->render('DrAdminBundle:info:show.html.twig', array(
            'info' => $info,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing info entity.
     *
     */
    public function editAction(Request $request, Info $info)
    {
        $deleteForm = $this->createDeleteForm($info);
        $editForm = $this->createForm('DrAdminBundle\Form\InfoType', $info);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('info_edit', array('id' => $info->getId()));
        }

        return $this->render('DrAdminBundle:info:edit.html.twig', array(
            'info' => $info,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a info entity.
     *
     */
    public function deleteAction(Request $request, Info $info)
    {
        $form = $this->createDeleteForm($info);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($info);
            $em->flush($info);
        }

        return $this->redirectToRoute('info_index');
    }

    /**
     * Creates a form to delete a info entity.
     *
     * @param Info $info The info entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Info $info)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('info_delete', array('id' => $info->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
