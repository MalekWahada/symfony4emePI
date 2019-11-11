<?php

namespace MaisonEditionBundle\Controller;

use MaisonEditionBundle\Entity\Maisonedition;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Maisonedition controller.
 *
 */
class MaisoneditionController extends Controller
{
    /**
     * Lists all maisonedition entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $maisoneditions = $em->getRepository('MaisonEditionBundle:Maisonedition')->findAll();

        return $this->render('maisonedition/index.html.twig', array(
            'maisoneditions' => $maisoneditions,
        ));
    }

    /**
     * Creates a new maisonedition entity.
     *
     */
    public function newAction(Request $request)
    {
        $maisonedition = new Maisonedition();
        $form = $this->createForm('MaisonEditionBundle\Form\MaisoneditionType', $maisonedition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($maisonedition);
            $em->flush();

            return $this->redirectToRoute('maisonedition_show', array('id' => $maisonedition->getId()));
        }

        return $this->render('maisonedition/new.html.twig', array(
            'maisonedition' => $maisonedition,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a maisonedition entity.
     *
     */
    public function showAction(Maisonedition $maisonedition)
    {
        $deleteForm = $this->createDeleteForm($maisonedition);

        return $this->render('maisonedition/show.html.twig', array(
            'maisonedition' => $maisonedition,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing maisonedition entity.
     *
     */
    public function editAction(Request $request, Maisonedition $maisonedition)
    {
        $deleteForm = $this->createDeleteForm($maisonedition);
        $editForm = $this->createForm('MaisonEditionBundle\Form\MaisoneditionType', $maisonedition);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('maisonedition_edit', array('id' => $maisonedition->getId()));
        }

        return $this->render('maisonedition/edit.html.twig', array(
            'maisonedition' => $maisonedition,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a maisonedition entity.
     *
     */
    public function deleteAction(Request $request, Maisonedition $maisonedition)
    {
        $form = $this->createDeleteForm($maisonedition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($maisonedition);
            $em->flush();
        }

        return $this->redirectToRoute('maisonedition_index');
    }

    /**
     * Creates a form to delete a maisonedition entity.
     *
     * @param Maisonedition $maisonedition The maisonedition entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Maisonedition $maisonedition)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('maisonedition_delete', array('id' => $maisonedition->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
