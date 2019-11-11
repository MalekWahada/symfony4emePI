<?php

namespace EvenementBundle\Controller;

use Doctrine\DBAL\Types\DateType;
use Doctrine\DBAL\Types\TextType;
use Doctrine\DBAL\Types\TimeType;
use EvenementBundle\Entity\Event;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Tests\Extension\Core\Type\TextTypeTest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToStringTransformer;

/**
 * Event controller.
 *
 */
class EventController extends Controller
{
    /**
     * Lists all event entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $events = $em->getRepository('EvenementBundle:Event')->findAll();

        return $this->render('@Evenement\Default\index.html.twig', array(
            'events' => $events,
        ));
    }


    /**
     * Finds and displays a event entity.
     *
     */
    public function showAction(Event $event)
    {
        $deleteForm = $this->createDeleteForm($event);

        return $this->render('@Evenement\Default\show.html.twig', array(
            'event' => $event,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing event entity.
     *
     */
    public function editAction(Request $request, Event $event)
    {
        $deleteForm = $this->createDeleteForm($event);
        $editForm = $this->createForm('EvenementBundle\Form\EventType', $event);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('event_edit', array('id' => $event->getId()));
        }

        return $this->render('@Evenement\Default\edit.html.twig', array(
            'event' => $event,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a event entity.
     *
     */
    public function deleteAction(Request $request, Event $event)
    {
        $form = $this->createDeleteForm($event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($event);
            $em->flush();
        }

        return $this->redirectToRoute('event_index');
    }

    /**
     * Creates a form to delete a event entity.
     *
     * @param Event $event The event entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Event $event)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('event_delete', array('id' => $event->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $events = $em->getRepository('EvenementBundle:Event')->findAll();

        if ($request->isMethod('POST')) {
            $nom = $request->get('nom');

            $events = $em->getRepository('EvenementBundle:Event')->findBy(array("nom" => $nom));

        }

        return $this->render('@Evenement\Default\search.html.twig', array('events' => $events));
    }





    public function supprimerAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $event = $this->getDoctrine()
            ->getRepository(Event::class)
            ->find($id);

        $entityManager->remove($event);
        $entityManager->flush();
        $event = $entityManager->getRepository('EvenementBundle:Event')->findAll();

        return $this->render('@Evenement\Default\index.html.twig', array(
            'events' => $event,
        ));

    }


    public function ajouterAction(Request $request)
    {


                if ($request->isMethod('POST')) {
                    $event = new Event();


                    $nom = $request->request->get('nom');
                    $lieu = $request->request->get('lieu');
                    $date = date('Y-m-d', strtotime($request->request->get('date')));
                    strtotime($heure= $request->request->get('heure') . "\n");
                    $description = $request->request->get('description');
                    $capacite = $request->request->get('capacite');
                    $nbre = $request->request->get('nbreParticipant');
                    $img = $request->request->get('img');

                        if($request->get('date')>date('Y-m-d')){

                    $event->setNom($nom);
                    $event->setLieu($lieu);
                    $event->setDate($date);
                    $event->setHeure($heure);
                    $event->setDescription($description);
                    $event->setCapacite($capacite);
                    $event->setNbreParticipant($nbre);
                    $event->setImg($img);

                    $form = $this->createFormBuilder($event)->getForm();

                    $form->handleRequest($request);


                    $event = $form->getData();
                    if($event !=null){

                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($event);
                    $entityManager->flush();
                    return $this->redirectToRoute('event_ajout');

            }
                        }else{
                            echo "<script>alert(\"Changer Date\")</script>";
                        }

                }

            return $this->render('@Evenement\Default\ajout.html.twig');

        }

    }
