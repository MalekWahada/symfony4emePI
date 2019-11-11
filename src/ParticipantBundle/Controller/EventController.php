<?php

namespace ParticipantBundle\Controller;

use EvenementBundle\Entity\Event;
use ParticipantBundle\Entity\Participant;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Tests\RequestContentProxy;


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
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $events = $em->getRepository('EvenementBundle:Event')->findAll();

        $paginator  = $this->get('knp_paginator');
        dump(get_class($paginator));
        $pagination = $paginator->paginate(
            $events, /* query NOT result */
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 2)
        );

        return $this->render('event/index.html.twig', array(
            'pagination' => $pagination,
        ));
    }

    /**
     * Finds and displays a event entity.
     *
     */
    public function showAction(Event $event)
    {

        return $this->render('@Participant\Default\show.html.twig', array(
            'event' => $event,
        ));
    }


    public function affichageAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $events = $em->getRepository('EvenementBundle:Event')->findAll();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $events, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );

        return $this->render('@Participant\Default\index.html.twig', array(
            'events' => $pagination,
        ));
    }


    public function participerAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $events = $em->getRepository('EvenementBundle:Event')->findAll();

        if ($request->isMethod("POST")) {
            $data = $request->request->all();
            $id = "";
            $capacite = "";
            $nbre = "";
            $i = 0;

            foreach ($data as $key => $value) {

                if ($i == 0) {
                    $id = $value;

                }
                $i = $i + 1;
            }

            $em = $this->getDoctrine()->getManager();
            //Ajouter
            $events = $em->getRepository("EvenementBundle:Event")->find($id);
            $participants = new Participant();
            $participants->setIdUser($this->getUser());
            $participants->setIdEvent($events);


            if ($request->get('date1') > date('Y-m-d')) {

                $capacite = $request->get('capacite');
                $nbre = $request->get('nbre');


                if ($capacite > $nbre) {
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($participants);
                    $em->flush();


                    $nbr = $events->getNbreParticipant();
                    dump($nbr);

                    $events->setNbreParticipant($nbr + 1);
                    $em->flush();
                    echo "<script>alert(\"Participation réussite\")</script>";

                    dump($data);

                $user = $this->getUser();
                dump($user);

                $participants = $em->getRepository('ParticipantBundle:Participant')->findBy(['idUser' => $user]);

                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $participants, /* query NOT result */
                    $request->query->getInt('page', 1)/*page number*/,
                    3/*limit per page*/
                );

                return $this->render('@Participant\Default\index2.html.twig', array('participants' => $pagination,
                ));

                } else {
                    echo "<script>alert(\"Evénement Saturé\")</script>";
                    $events = $em->getRepository('EvenementBundle:Event')->findAll();

                    $paginator = $this->get('knp_paginator');
                    $pagination = $paginator->paginate(
                        $events, /* query NOT result */
                        $request->query->getInt('page', 1)/*page number*/,
                        3/*limit per page*/
                    );

                    return $this->render('@Participant\Default\index.html.twig', array(
                        'events' => $pagination,
                    ));
                }


            } else {

                echo "<script>alert(\"Evénement est déjà passé\")</script>";

                $events = $em->getRepository('EvenementBundle:Event')->findAll();

                $paginator = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $events, /* query NOT result */
                    $request->query->getInt('page', 1)/*page number*/,
                    3/*limit per page*/
                );

                return $this->render('@Participant\Default\index.html.twig', array(
                    'events' => $pagination,
                ));

            }



    }
        $user = $this->getUser();
        $participants = $em->getRepository('ParticipantBundle:Participant')->findBy(['idUser' => $user]);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $participants, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            3/*limit per page*/
        );

        return $this->render('@Participant\Default\index2.html.twig', array('participants' => $pagination,
        ));
    }


    public function supprimerAction($id,Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $participant = $this->getDoctrine()
            ->getRepository(Participant::class)
            ->find($id);
        dump($participant);
        if($request->get('date')>date('Y-m-d') ) {

            $entityManager->remove($participant);
            $entityManager->flush();

            $data = $request->request->all();

            $nbre="";
            $id="";

            foreach ($data as $key=>$value){


                    $id=$value;
            }
            $em = $this->getDoctrine()->getManager();
            $events = $em->getRepository("EvenementBundle:Event")->find($id);
            $nbr = $events->getNbreParticipant();
            dump($nbr);

            $events->setNbreParticipant($nbr - 1);
            $em->flush();

    }     else{

            echo "<script>alert(\"Vous étiez déjà à l'événement\")</script>";
        }

        $user=$this->getUser();
        dump($user);

        $participants = $entityManager->getRepository('ParticipantBundle:Participant')->findBy(['idUser'=> $user]);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $participants, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            3/*limit per page*/
        );

        return $this->render('@Participant\Default\index2.html.twig', array(
            'participants' => $pagination,
        ));

    }

    public function affAction(){

        $em = $this->getDoctrine()->getManager();

        $events = $em->getRepository('EvenementBundle:Event')->findAll();

        return $this->render('@Participant\Default\search.html.twig', array(
            'events' => $events, ));
    }


    public function searchAction(Request $request)
    {

        if ($request->isMethod('POST')) {

            $nom = $request->request->get('nom');
            $lieu = $request->request->get('lieu');


            $em = $this->getDoctrine()->getManager();
            $events = $em->getRepository('EvenementBundle:Event')
                ->findBy(array("nom" => $nom, "lieu" => $lieu));

        }


        return $this->render('@Participant\Default\search1.html.twig',
            array('events' => $events));


    }

}
