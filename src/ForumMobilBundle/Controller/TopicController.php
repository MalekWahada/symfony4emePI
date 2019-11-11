<?php

namespace ForumMobilBundle\Controller;

use ForumMobilBundle\Entity\Comments;
use ForumMobilBundle\Entity\Topic;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;

class TopicController extends Controller
{
    public function indexAction()
    {
        return $this->render('@ForumMobil\Default\index.html.twig');
    }
    public function newTopicAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $tp = new Topic();
        $tp->setIdtopic($request->get('idtopic'));
        $tp->setIduser($request->get('iduser'));
        $tp->setTopicname($request->get('topicname'));
        $tp->setTimetopic($request->get('timeTopic'));

        $currTime = new \DateTime();
        $tp->setTimetopic($currTime);

        $em->persist($tp);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($tp);
        return new JsonResponse($formatted);

    }

    public function showTopicAction()
    {

        $topics= $this->getDoctrine()->getManager()
            ->getRepository('ForumMobilBundle:Topic')
        ->findAll();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($topics);
        return new JsonResponse($formatted);

    }

    public function deleteTopicAction($idtopic)
    {
       $em = $this->getDoctrine()->getManager();
        $topics =   $em->getRepository('ForumMobilBundle:Topic')->find($idtopic);

        $cmmts = $em->getRepository('ForumMobilBundle:Comments')->findByIdtopic($idtopic);


        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($topics);
        dump($cmmts);

        foreach ($cmmts as $cv)
        {$em->remove($cv);}

        $em->remove($topics);

        $em->flush();

        return new JsonResponse($formatted);
    }

     public function UpdateTopicAction(Request $request)
{



        $em= $this->getDoctrine()->getManager();
        $topEdit= $em->getRepository('ForumMobilBundle:Topic')->find($request->get('idtopic'));

        $topEdit->setIduser($request->get('iduser'));
        $topEdit->setTopicname($request->get('topicname'));

        $currTime = new \DateTime();
        $topEdit->setTimetopic($currTime);
        $em->flush();

    $serializer = new Serializer([new ObjectNormalizer()]);
    $formatted = $serializer->normalize($topEdit);
    return new JsonResponse($formatted);

}

public function showTopicCmmtAction($idtopic)
     {
    $em = $this->getDoctrine()->getManager();

    $comments = $em->getRepository('ForumMobilBundle:Comments')->findByIdtopic($idtopic);
    $serializer = new Serializer([new ObjectNormalizer()]);
    $formatted = $serializer->normalize($comments);
    return new JsonResponse($formatted);
     }

     public function siganlcmmtAction(Request $request)
     {
         $em= $this->getDoctrine()->getManager();
         $cmmtEdit= $em->getRepository('ForumMobilBundle:Comments')->find($request->get('idcmmt'));

         //$m = $request->get('nbsiganl')+1;
         $cmmtEdit->setNbsignal($request->get('nbsiganl'));
         $em->flush();

         $serializer = new Serializer([new ObjectNormalizer()]);
         $formatted = $serializer->normalize($cmmtEdit);
         return new JsonResponse($formatted);
        }


    public function likecmmtAction(Request $request)
    {
        $em= $this->getDoctrine()->getManager();
        $cmmtEdit= $em->getRepository('ForumMobilBundle:Comments')->find($request->get('idcmmt'));

        $cmmtEdit->setNblikes($request->get('nblikes'));
        $em->flush();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($cmmtEdit);
        return new JsonResponse($formatted);
    }


    public function deletecmmtAction($idcmmt)
    {

        $em = $this->getDoctrine()->getManager();
        $cmmts =   $em->getRepository('ForumMobilBundle:Comments')->find($idcmmt);



        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($cmmts);

        $em->remove($cmmts);
        $em->flush();

        return new JsonResponse($formatted);
    }


    public function updatecmmtAction(Request $request)
    {

        $em= $this->getDoctrine()->getManager();
        $cmmtEdit= $em->getRepository('ForumMobilBundle:Comments')->find($request->get('idcmmt'));

        $cmmtEdit->setCmmt($request->get('cmmt'));

        $currTime = new \DateTime();
        $cmmtEdit->setTimecmmt($currTime);
        $em->flush();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($cmmtEdit);
        return new JsonResponse($formatted);

    }

    public function addCmmtAction(Request $request,Topic $idt)
    {
        $em = $this->getDoctrine()->getManager();
        $cmmt = new Comments();
        $cmmt->setIdtopic($idt);
        $cmmt->setIduser($request->get('iduser'));
        $cmmt->setCmmt($request->get('cmmt'));
        $cmmt->setTimecmmt($request->get('timecmmt'));

        $currTime = new \DateTime();
        $cmmt->setTimecmmt($currTime);
        $cmmt->setNblikes($request->get('nblikes'));
        $cmmt->setNbsignal($request->get('nbsignal'));

        $em->persist($cmmt);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($cmmt);
        return new JsonResponse($formatted);


    } public function getAllCmmtAction()
{

    $cmmts= $this->getDoctrine()->getManager()
        ->getRepository('ForumMobilBundle:Comments')
        ->findAll();

    $serializer = new Serializer([new ObjectNormalizer()]);
    $formatted = $serializer->normalize($cmmts);
    return new JsonResponse($formatted);

}

public function getAllUsersAction()
{

    $em = $this->getDoctrine()->getManager();

    $usrs11 = $em->getRepository('ForumMobilBundle:Membre')
        ->createQueryBuilder('q')
        ->getQuery()
        ->getArrayResult();
    //var_dump($usrs11);
    $serializer = new Serializer([new ObjectNormalizer()]);
    $formatted = $serializer->normalize($usrs11);
    return new JsonResponse($formatted);

}

}
