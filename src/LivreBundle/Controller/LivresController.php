<?php

namespace LivreBundle\Controller;

use LivreBundle\Entity\Livres;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Endroid\QrCode\Bundle\QrCodeBundle\EndroidQrCodeBundle;
use Endroid\QrCode\QrCode;
/**
 * Livre controller.
 *
 */

class LivresController extends Controller
{
    /**
     * Lists all livre entities.
     *
     */

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $livres = $em->getRepository('LivreBundle:Livres')->findAll();
        $livre = new Livres();
        return $this->render('@Livre\Default\index.html.twig', array(
            'livres' => $livres,
        ));
    }
    /**
     * Creates a new livre entity.
     *
     */
    public function newAction(Request $request)
    {
        $livre = new Livres();
        $form = $this->createForm('LivreBundle\Form\LivresType', $livre);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($livre);
            $livre->setCodeqr('/Images/'.$livre->getNom().'.png');
            $file= $livre->getImg();
            $fileN=md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('upload_directory'),$fileN);
            $livre->setImg("/project/taswira/".$fileN);
            $soum=$livre->getPrix()-($livre->getPrix()*($livre->getPromo()->getValeur()/100));
            $livre->setPrix($soum);
            $em->flush();
            $this->generateqr($livre);

            return $this->redirectToRoute('livres_show', array('id' => $livre->getId()));
        }

        return $this->render('@Livre\Default\new.html.twig', array(
            'livre' => $livre,
            'form' => $form->createView(),
        ));
    }


    /**
     * Finds and displays a livre entity.
     *
     */
    public function showAction(Livres $livre)
    {
        $deleteForm = $this->createDeleteForm($livre);

        return $this->render('@Livre\Default\show.html.twig', array(
            'livre' => $livre,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function shouAction(Livres $livre)
    {
        $deleteForm = $this->createDeleteForm($livre);

        return $this->render('@Livre\Default\go.html.twig', array(
            'livre' => $livre,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Displays a form to edit an existing livre entity.
     *
     */
    public function editAction(Request $request, Livres $livre)
    {
        $deleteForm = $this->createDeleteForm($livre);
        $editForm = $this->createForm('LivreBundle\Form\LivresType', $livre);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em=$this->getDoctrine()->getManager();
            $file= $livre->getImg();
            $fileN=md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('upload_directory'),$fileN);
            $livre->setImg("/project/taswira/".$fileN);
            $em ->flush();

            return $this->redirectToRoute('livres_index');
        }

        return $this->render('@Livre\Default\edit.html.twig', array(
            'livre' => $livre,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a livre entity.
     *
     */
    public function deleteAction(Request $request, Livres $livre)
    {   $form = $this->createDeleteForm($livre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($livre);
            $em->flush();
        }

        return $this->redirectToRoute('livres_index');
    }

    /**
     * Creates a form to delete a livre entity.
     *
     * @param Livres $livre The livre entity
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(Livres $livre)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('livres_delete', array('id' => $livre->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    public function generateqr(Livres $livre){

        // Create a basic QR code
        $qrCode = new QrCode('Nom du livre : '.$livre->getNom().' Son prix: '.$livre->getPrix().' Dinar');
        $qrCode->setSize(100);

// Set advanced options
        $qrCode->setWriterByName('png');
        $qrCode->setMargin(10);
        $qrCode->setEncoding('UTF-8');
        $qrCode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0]);
        $qrCode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 0]);

        $qrCode->setValidateResult(false);


// Directly output the QR code
        header('Content-Type: '.$qrCode->getContentType());


// Save it to a file
        $qrCode->writeFile('C:\wamp64\www\Images/'.$livre->getNom().'.png');



    }



}
