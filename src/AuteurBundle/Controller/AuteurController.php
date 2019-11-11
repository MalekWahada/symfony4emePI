<?php

namespace AuteurBundle\Controller;

use AuteurBundle\Entity\Auteur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;
/**
 * Auteur controller.
 *
 */
class AuteurController extends Controller
{
    /**
     * Lists all auteur entities.
     *
     */

    public function indexAction(Request $request)
    {/*$current_timestamp = time();
        echo $current_timestamp. "<br>";
        $d=date('d/m/Y', $current_timestamp-3*86400);
        echo $d. "<br>";
      echo gettype($d);*/


        $em = $this->getDoctrine()->getManager();

        //$auteurs = $em->getRepository('AuteurBundle:Auteur')->findAll();
        $dql = "SELECT bp FROM AuteurBundle:Auteur bp";
        dump($request);


        $query= $em->createQuery($dql);

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */




        $paginator = $this->get('knp_paginator');
        $result= $paginator->paginate(
            $query,
            $request->query->getInt('page',1),5
        //$request->query->getInt('limit',5)
        );


        return $this->render('@Auteur\Default\index.html.twig', array(
            'auteurs' => $result,
        ));
    }

    /**
     * Creates a new auteur entity.
     *
     */
    public function newAction(Request $request)
    {
        $auteur = new Auteur();
        $form = $this->createForm('AuteurBundle\Form\AuteurType', $auteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($auteur);
            $em->flush();

            return $this->redirectToRoute('auteur_show', array('idautr' => $auteur->getIdautr()));
        }

        return $this->render('@Auteur\Default\new.html.twig', array(
            'auteur' => $auteur,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a auteur entity.
     *
     */
    public function showAction(Auteur $auteur)
    {
        $deleteForm = $this->createDeleteForm($auteur);

        return $this->render('@Auteur\Default\show.html.twig', array(
            'auteur' => $auteur,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing auteur entity.
     *
     */
    public function editAction(Request $request, Auteur $auteur)
    {
        $deleteForm = $this->createDeleteForm($auteur);
        $editForm = $this->createForm('AuteurBundle\Form\AuteurType', $auteur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('auteur_edit', array('idautr' => $auteur->getIdautr()));
        }

        return $this->render('@Auteur\Default\edit.html.twig', array(
            'auteur' => $auteur,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a auteur entity.
     *
     */
    public function deleteAction(Request $request, Auteur $auteur)
    {
        $form = $this->createDeleteForm($auteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($auteur);
            $em->flush();
        }

        return $this->redirectToRoute('@Auteur\Default\index.html.twig');
    }

    /**
     * Creates a form to delete a auteur entity.
     *
     * @param Auteur $auteur The auteur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Auteur $auteur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('auteur_delete', array('idautr' => $auteur->getIdautr())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


    public function deleteFromIndexAction(Auteur $id)
    {


        $em = $this->getDoctrine()->getManager();
        $post=$em->getRepository('AuteurBundle:Auteur')->find($id);
        //$em->remove($auteur);

        $em->remove($post);
        $em->flush();
        $this->addFlash('message','Auteur supprime avec succes ');


        return $this->redirectToRoute('auteur_index');
    }



}
