<?php

namespace EchangeBundle\Controller;

use EchangeBundle\Entity\Echange;
use EchangeBundle\Entity\Livres;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;

/**
 * Echange controller.
 *
 */
class EchangeController extends Controller
{
    /**
     * Lists all echange entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $echanges = $em->getRepository('EchangeBundle:Echange')->findAll();

        return $this->render('@Echange\Default\index.html.twig', array(
            'echanges' => $echanges,
        ));
    }
    public function index1Action()
    {
        $em = $this->getDoctrine()->getManager();

        $echanges = $em->getRepository('EchangeBundle:Echange')->findAll();

        return $this->render('@Echange\Default\index1.html.twig', array(
            'echanges' => $echanges,
        ));
    }
    /**
     * Creates a new echange entity.
     *
     */
    public function newAction(Request $request)
    {
        $echange = new Echange();
        $form = $this->createForm('EchangeBundle\Form\EchangeType', $echange);
        $form->handleRequest($request);

        if ($form->isSubmitted() ) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($echange);
            $em->flush();

            return $this->redirectToRoute('echange_show', array('idech' => $echange->getIdech()));
        }

        return $this->render('@Echange\Default\new.html.twig', array(
            'echange' => $echange,
            'form' => $form->createView(),
        ));
    }
    public function new1Action(Request $request)
    {
        $echange = new Echange();
        $form = $this->createForm('EchangeBundle\Form\EchangeType', $echange);
        $form->handleRequest($request);

        if ($form->isSubmitted() ) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($echange);
            $em->flush();

            return $this->redirectToRoute('echange_show1', array('idech' => $echange->getIdech()));
        }

        return $this->render('@Echange\Default\new1.html.twig', array(
            'echange' => $echange,
            'form' => $form->createView(),
        ));
    }
    /**
     * Finds and displays a echange entity.
     *
     */

    public function PDFAction(Echange $echange)
    {    $deleteForm = $this->createDeleteForm($echange);
        $snappy = $this->get('knp_snappy.pdf');

        $html =$this->render('@Echange\Default\test.html.twig',array(
            'echange' => $echange,
            'delete_form' => $deleteForm->createView(),
        ));
            //..Send some data to your view if you need to //


        $filename = 'myFirstSnappyPDF';

        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'echange' => $echange,
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'inline; filename="'.$filename.'.pdf"'
            )

        );
       /* $this->get('knp_snappy.pdf')->generateFromHtml(
            $this->redirectToRoute('echange_show',
                array(
                    'idech' => $echange->getIdech()
                )
            ),
            'C:\wamp\www\project\web\file.pdf'
        );*/
    }
    public function PDF1Action(Echange $echange)
    {    $deleteForm = $this->createDeleteForm($echange);
        $snappy = $this->get('knp_snappy.pdf');

        $html =$this->render('@Echange\Default\test.html.twig',array(
            'echange' => $echange,
            'delete_form' => $deleteForm->createView(),
        ));
        //..Send some data to your view if you need to //


        $filename = 'myFirstSnappyPDF';

        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'echange' => $echange,
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'inline; filename="'.$filename.'.pdf"'
            )

        );
        /* $this->get('knp_snappy.pdf')->generateFromHtml(
             $this->redirectToRoute('echange_show',
                 array(
                     'idech' => $echange->getIdech()
                 )
             ),
             'C:\wamp\www\project\web\file.pdf'
         );*/
    }
    public function showAction(Echange $echange)
    {   $deleteForm = $this->createDeleteForm($echange);
        if (isset($_GET["pdf"])){
        return $this->redirectToRoute('echange_pdf', array('idech' => $echange->getIdech()));
        }
        return $this->render('@Echange\Default\show.html.twig', array(
            'echange' => $echange,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    public function show1Action(Echange $echange)
    {   $deleteForm = $this->createDeleteForm($echange);
        if (isset($_GET["pdf"])){
            return $this->redirectToRoute('echange_pdf1', array('idech' => $echange->getIdech()));
        }
        return $this->render('@Echange\Default\show1.html.twig', array(
            'echange' => $echange,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Displays a form to edit an existing echange entity.
     *
     */
    public function editAction(Request $request, Echange $echange)
    {
        $em = $this->getDoctrine()->getManager();

        $echanges = $em->getRepository('EchangeBundle:Echange')->findAll();
        $deleteForm = $this->createDeleteForm($echange);
        $editForm = $this->createForm('EchangeBundle\Form\EchangeType', $echange);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('echange_edit', array('idech' => $echange->getIdech()));
        }

        return $this->render('@Echange\Default\edit.html.twig', array(
            'echange' => $echange,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    public function edit1Action(Request $request, Echange $echange)
    {
        $em = $this->getDoctrine()->getManager();

        $echanges = $em->getRepository('EchangeBundle:Echange')->findAll();
        $deleteForm = $this->createDeleteForm($echange);
        $editForm = $this->createForm('EchangeBundle\Form\EchangeType', $echange);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('echange_edit1', array('idech' => $echange->getIdech()));
        }

        return $this->render('@Echange\Default\edit1.html.twig', array(
            'echange' => $echange,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a echange entity.
     *
     */
    public function deleteAction(Request $request, Echange $echange)
    {
        $form = $this->createDeleteForm($echange);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($echange);
            $em->flush();
        }

        return $this->redirectToRoute('echange_index');
    }
    public function delete1Action(Request $request, Echange $echange)
    {
        $form = $this->createDeleteForm($echange);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($echange);
            $em->flush();
        }

        return $this->redirectToRoute('echange_index1');
    }
    public function GmapAction(){
        return $this->render('@Echange\Default\Gmap.html.twig');
    }

    /**
     * Creates a form to delete a echange entity.
     *
     * @param Echange $echange The echange entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Echange $echange)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('echange_delete', array('idech' => $echange->getIdech())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

        public function supprimerAction($idech){
        $entityManager = $this->getDoctrine()->getManager();
        $Echanges = $this->getDoctrine()
            ->getRepository(Echange::class)
            ->find($idech);

        $entityManager->remove($Echanges);
        $entityManager->flush();
        $Echange = $entityManager->getRepository('EchangeBundle:Echange')->findAll();

        return $this->render('@Echange\Default\index.html.twig', array(
            'echanges' => $Echange,
        ));
    }
}
