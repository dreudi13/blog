<?php

namespace DrAdminBundle\Controller;

use DrAdminBundle\Entity\Tool;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Tool controller.
 *
 */
class ToolController extends Controller
{
    /**
     * Lists all tool entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tools = $em->getRepository('DrAdminBundle:Tool')->findAll();

        return $this->render('DrAdminBundle:tool:index.html.twig', array(
            'tools' => $tools,
        ));
    }

    /**
     * Creates a new tool entity.
     *
     */
    public function newAction(Request $request)
    {
        $tool = new Tool();
        $form = $this->createForm('DrAdminBundle\Form\ToolType', $tool);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tool);
            $em->flush($tool);

            return $this->redirectToRoute('tool_show', array('id' => $tool->getId()));
        }

        return $this->render('DrAdminBundle:tool:new.html.twig', array(
            'tool' => $tool,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tool entity.
     *
     */
    public function showAction(Tool $tool)
    {
        $deleteForm = $this->createDeleteForm($tool);

        return $this->render('DrAdminBundle:tool:show.html.twig', array(
            'tool' => $tool,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tool entity.
     *
     */
    public function editAction(Request $request, Tool $tool)
    {
        $deleteForm = $this->createDeleteForm($tool);
        $editForm = $this->createForm('DrAdminBundle\Form\ToolType', $tool);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tool_edit', array('id' => $tool->getId()));
        }

        return $this->render('DrAdminBundle:tool:edit.html.twig', array(
            'tool' => $tool,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tool entity.
     *
     */
    public function deleteAction(Request $request, Tool $tool)
    {
        $form = $this->createDeleteForm($tool);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tool);
            $em->flush($tool);
        }

        return $this->redirectToRoute('tool_index');
    }

    /**
     * Creates a form to delete a tool entity.
     *
     * @param Tool $tool The tool entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tool $tool)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tool_delete', array('id' => $tool->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
