<?php

namespace LocauxBundle\Controller;

use LocauxBundle\Entity\Locaux;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Locaux controller.
 *
 */
class LocauxController extends Controller
{
    /**
     * Lists all locaux entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $locauxes = $em->getRepository('LocauxBundle:Locaux')->findAll();

        return $this->render('@Locaux\Default\index.html.twig', array(
            'locauxes' => $locauxes,
        ));
    }

    /**
     * Creates a new locaux entity.
     *
     */
    public function newAction(Request $request)
    {
        $locaux = new Locaux();
        $form = $this->createForm('LocauxBundle\Form\LocauxType', $locaux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($locaux);
            $em->flush();

            return $this->render('@Locaux\Default\Gmap.html.twig', array('locaux' => $locaux));
        }

        return $this->render('@Locaux\Default\new.html.twig', array(
            'locaux' => $locaux,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a locaux entity.
     *
     */
    public function showAction(Locaux $locaux)
    {
        $deleteForm = $this->createDeleteForm($locaux);

        return $this->render('@Locaux\Default\show.html.twig', array(
            'locaux' => $locaux,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing locaux entity.
     *
     */
    public function editAction(Request $request, Locaux $locaux)
    {
        $deleteForm = $this->createDeleteForm($locaux);
        $editForm = $this->createForm('LocauxBundle\Form\LocauxType', $locaux);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('locaux_edit', array('idloc' => $locaux->getIdloc()));
        }

        return $this->render('@Locaux\Default\edit.html.twig', array(
            'locaux' => $locaux,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a locaux entity.
     *
     */
    public function deleteAction(Request $request, Locaux $locaux)
    {
        $form = $this->createDeleteForm($locaux);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($locaux);
            $em->flush();
        }

        return $this->redirectToRoute('locaux_index');
    }
    public function GmapAction(){
        return $this->render('@Locaux\Default\Gmap.html.twig');
    }
    /**
     * Creates a form to delete a locaux entity.
     *
     * @param Locaux $locaux The locaux entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Locaux $locaux)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('locaux_delete', array('idloc' => $locaux->getIdloc())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
