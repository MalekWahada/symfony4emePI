<?php

namespace MlkStatBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\LineChart;
use MlkStatBundle\Entity\Comments;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\Material\ScatterChart;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Comment controller.
 *
 */
class CommentsController extends Controller
{
    /**
     * Lists all comment entities.
     *
     */
    public function indexAction()
    { //$linechart = new LineChart();


        $em= $this->getDoctrine();
        $comments = $em->getRepository(Comments::class)->findAll();


        $i1=0; $i2=0; $i3=0; $i4=0; $i5=0; $i6=0; $i7=0;
        $i8=0;$i9=0;$i10=0;$i11=0;$i12=0;
        $i13=0;$i14=0;$i15=0;$i16=0;$i17=0;$i18=0;$i19=0;$i20=0;
        $currTime = time();
        //echo $currTime;
        $s=60*60*24;  ///86400

        //////////////   extraire le nb des cmmt /jour [aujourdui ---->  7jours avants]

        foreach($comments as $classe) {
            $CmmtTime=$classe->getTimecmmt()->getTimestamp();
           // echo $CmmtTime."<br>";
            if($CmmtTime<$currTime  && $CmmtTime> ($currTime-1*$s))
                $i1++;
            if($CmmtTime<($currTime-1*$s)  && $CmmtTime> ($currTime-2*$s))
                $i2++;
            if($CmmtTime<($currTime-2*$s)  && $CmmtTime> ($currTime-3*$s))
                $i3++;
            if($CmmtTime<($currTime-3*$s)  && $CmmtTime> ($currTime-4*$s))
                $i4++;
            if($CmmtTime<($currTime-4*$s)  && $CmmtTime> ($currTime-5*$s))
                $i5++;
            if($CmmtTime<($currTime-5*$s)  && $CmmtTime> ($currTime-6*$s))
                $i6++;
            if($CmmtTime<($currTime-6*$s)  && $CmmtTime> ($currTime-7*$s))
                $i7++;
            if($CmmtTime<($currTime-7*$s)  && $CmmtTime> ($currTime-8*$s))
                $i8++;
            if($CmmtTime<($currTime-8*$s)  && $CmmtTime> ($currTime-9*$s))
                $i9++;
            if($CmmtTime<($currTime-9*$s)  && $CmmtTime> ($currTime-10*$s))
                $i10++;

            if($CmmtTime<($currTime-10*$s)  && $CmmtTime> ($currTime-11*$s))
                $i11++;
            if($CmmtTime<($currTime-11*$s)  && $CmmtTime> ($currTime-12*$s))
                $i12++;
            if($CmmtTime<($currTime-12*$s)  && $CmmtTime> ($currTime-13*$s))
                $i13++;
            if($CmmtTime<($currTime-13*$s)  && $CmmtTime> ($currTime-14*$s))
                $i14++;
            if($CmmtTime<($currTime-14*$s)  && $CmmtTime> ($currTime-15*$s))
                $i15++;
            if($CmmtTime<($currTime-15*$s)  && $CmmtTime> ($currTime-16*$s))
                $i16++;
            if($CmmtTime<($currTime-16*$s)  && $CmmtTime> ($currTime-17*$s))
                $i17++;
            if($CmmtTime<($currTime-17*$s)  && $CmmtTime> ($currTime-18*$s))
                $i18++;
            if($CmmtTime<($currTime-18*$s)  && $CmmtTime> ($currTime-19*$s))
                $i19++;
            if($CmmtTime<($currTime-19*$s)  && $CmmtTime> ($currTime-20*$s))
                $i20++;


        }
//echo "les i    ".$i1." ".$i2." ".$i3." ".$i4." ".$i5." ".$i6." ".$i7." ";
        ////////////////////////////// remplir data par les values/////////////////

        $date = new DateTime();
        echo $date;



        $currTime = time();
        $d=date('d/m/Y', $currTime);
        $data= array();
        $stat=['date', 'nbComments'];
        array_push($data,$stat);
        $stat=array();

        array_push($stat,$d,$i1);

        $d1=date('d/m/Y', $currTime-1*$s);
        array_push($stat,$d1,$i2);


        $d2=date('d/m/Y', $currTime-2*$s);
        array_push($stat,$d2,$i3);


        $d3=date('d/m/Y', $currTime-3*$s);
        array_push($stat,$d3,$i4);


        $d4=date('d/m/Y', $currTime-4*$s);
        array_push($stat,$d4,$i5);


        $d5=date('d/m/Y', $currTime-5*$s);
        array_push($stat,$d5,$i6);


        $d6=date('d/m/Y', $currTime-6*$s);
        array_push($stat,$d6,$i7);

        $d8=date('d/m/Y', $currTime-7*$s);
        array_push($stat,$d8,$i8);

        $d9=date('d/m/Y', $currTime-8*$s);
        array_push($stat,$d9,$i9);

        $d10=date('d/m/Y', $currTime-9*$s);
        array_push($stat,$d10,$i10);

        $d11=date('d/m/Y', $currTime-10*$s);
        array_push($stat,$d11,$i11);

        $d12=date('d/m/Y', $currTime-11*$s);
        array_push($stat,$d12,$i12);


        $d13=date('d/m/Y', $currTime-11*$s);
        array_push($stat,$d13,$i13);


        $d14=date('d/m/Y', $currTime-11*$s);
        array_push($stat,$d14,$i14);


        $d15=date('d/m/Y', $currTime-11*$s);
        array_push($stat,$d15,$i15);


        $d16=date('d/m/Y', $currTime-11*$s);
        array_push($stat,$d16,$i16);


        $d17=date('d/m/Y', $currTime-11*$s);
        array_push($stat,$d17,$i17);


        $d18=date('d/m/Y', $currTime-11*$s);
        array_push($stat,$d18,$i18);

        $d19=date('d/m/Y', $currTime-11*$s);
        array_push($stat,$d19,$i19);

        $d20=date('d/m/Y', $currTime-11*$s);
        array_push($stat,$d20,$i20);





        $chart = new LineChart();
//var_dump($stat);

        $scatter = new ScatterChart();
        $scatter->getData()->setArrayToDataTable([
            ['Date', 'nombre de likes'],
            [ $d,      $i1],
            [ $d1,      $i2],
            [ $d2,     $i3],
            [ $d3,      $i4],
            [ $d4,      $i5],
            [ $d5,    $i6],
            [ $d6,     $i7],
            [ $d8,      $i8],
            [ $d9,      $i9],
            [ $d10,    $i10]
        ]);
        $scatter->getOptions()->setTitle('nb de commentaires / jour');
        $scatter->getOptions()->getHAxis()->setTitle('Dates');
        $scatter->getOptions()->getHAxis()->setMinValue(0);
        $scatter->getOptions()->getHAxis()->setMaxValue(15);
        $scatter->getOptions()->getVAxis()->setTitle('nb commentaires');
        $scatter->getOptions()->getVAxis()->setMinValue(0);
        $scatter->getOptions()->getVAxis()->setMaxValue(15);
        $scatter->getOptions()->getLegend()->setPosition('none');

        return $this->render('@MlkStat\Default\index.html.twig',
            array('lc' => $scatter));
    }

    /**
     * Creates a new comment entity.
     *
     */
    public function newAction(Request $request)
    {
        $comment = new Comment();
        $form = $this->createForm('MlkStatBundle\Form\CommentsType', $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('comments_show', array('idcmmt' => $comment->getIdcmmt()));
        }

        return $this->render('comments/new.html.twig', array(
            'comment' => $comment,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a comment entity.
     *
     */
    public function showAction(Comments $comment)
    {
        $deleteForm = $this->createDeleteForm($comment);

        return $this->render('comments/show.html.twig', array(
            'comment' => $comment,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing comment entity.
     *
     */
    public function editAction(Request $request, Comments $comment)
    {
        $deleteForm = $this->createDeleteForm($comment);
        $editForm = $this->createForm('MlkStatBundle\Form\CommentsType', $comment);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('comments_edit', array('idcmmt' => $comment->getIdcmmt()));
        }

        return $this->render('comments/edit.html.twig', array(
            'comment' => $comment,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a comment entity.
     *
     */
    public function deleteAction(Request $request, Comments $comment)
    {
        $form = $this->createDeleteForm($comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($comment);
            $em->flush();
        }

        return $this->redirectToRoute('comments_index');
    }

    /**
     * Creates a form to delete a comment entity.
     *
     * @param Comments $comment The comment entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Comments $comment)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('comments_delete', array('idcmmt' => $comment->getIdcmmt())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
