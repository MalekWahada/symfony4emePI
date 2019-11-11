<?php

namespace EmpruntBundle\Controller;

use EmpruntBundle\Entity\Emprunt;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;

/**
 * Emprunt controller.
 *
 */
class EmpruntController extends Controller
{
    /**
     * Lists all emprunt entities.
     *
     */
    public function indexAction(Request $request)
    {


        $em = $this->getDoctrine()->getManager();


        $emprunts = $em->getRepository('EmpruntBundle:Emprunt')->findAll();
         $compter=0;
        foreach ($emprunts as $emprunt) {
            $compter=$compter+1;
            $date = $emprunt->getDate();


            $day = intval(date_format($date, 'd'));
            $month = intval(date_format($date, 'm'));
            $year = intval(date_format($date, 'Y'));

            $dd = intval($timed = date('d'));
            $mm = intval($timed = date('m'));
            $yy = intval($timed = date('Y'));

            //echo "dd".$dd;
            //echo "day".$day;
            if ($yy - $year > 0 ) {
               // echo "supprimer year";
                $em = $this->getDoctrine()->getManager();
                $em->remove($emprunt);
                $em->flush();

                if ($mm - $month > 0) {
                    //echo "supprimer month";
                    $em = $this->getDoctrine()->getManager();
                    $em->remove($emprunt);
                    $em->flush();

                    if ($dd - $day > 5) {
                       // echo "supprimer day";


                        $em = $this->getDoctrine()->getManager();
                        $em->remove($emprunt);
                        $em->flush();
                    }
                }
            }
        }
        if ($request->isMethod('GET')) {
            $em = $this->getDoctrine()->getManager();
            $serie = $request->get('id');
            $voitures = $em->getRepository("EmpruntBundle:Emprunt")->findBy(['id'=>$serie]);

            foreach ($voitures as $v) {

                if(isset($_POST['id'])){
                    return $this->redirectToRoute('emprunt_edit', array('id' => $v->getId()));


                }
            }
        }
        $compter1 = $em->getRepository("EmpruntBundle:Emprunt")->compter();

        if(isset($_GET['select'])) {
            if ($_GET['select'] == "emprunter") {
                $emprunts = $em->getRepository('EmpruntBundle:Emprunt')->findBy(['emprunter' => 1]);
            } else if ($_GET['select'] == "non emprunter") {
                $emprunts = $em->getRepository('EmpruntBundle:Emprunt')->findBy(['emprunter' => 0]);

            } else {
                $emprunts = $em->getRepository('EmpruntBundle:Emprunt')->findAll();
            }
        }

$array=array();
        $array2=array();
        foreach ($compter1 as $cmp) {

            array_push($array,$cmp['nomlivre'],$cmp['nb']);

        }
      //  var_dump($array);


        $pieChart = new PieChart();


            $pieChart->getData()->setArrayToDataTable([
                    ['Task', 'Hours per Day'],
            $array,
                    ]
                );


        $pieChart->getOptions()->setTitle('My Daily Activities');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);

        return $this->render('emprunt/index.html.twig', array(
            'emprunts' => $emprunts,
            'compter'=>$compter,
            'compter11'=>$compter1,
            'piechart' => $pieChart,
        ));

    }

    /**
     * Creates a new emprunt entity.
     *
     */
    public function newAction(Request $request)
    {
        $emprunt = new Emprunt();
        $form = $this->createForm('EmpruntBundle\Form\EmpruntType', $emprunt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($emprunt);
            $em->flush();

            return $this->redirectToRoute('emprunt_show', array('id' => $emprunt->getId()));
        }

        return $this->render('emprunt/new.html.twig', array(
            'emprunt' => $emprunt,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a emprunt entity.
     *
     */
    public function showAction(Emprunt $emprunt)
    {
        $deleteForm = $this->createDeleteForm($emprunt);

        return $this->render('emprunt/show.html.twig', array(
            'emprunt' => $emprunt,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing emprunt entity.
     *
     */
    public function editAction(Request $request, Emprunt $emprunt)
    {
        $deleteForm = $this->createDeleteForm($emprunt);
        $editForm = $this->createForm('EmpruntBundle\Form\EmpruntType', $emprunt);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('emprunt_edit', array('id' => $emprunt->getId()));
        }

        return $this->render('emprunt/edit.html.twig', array(
            'emprunt' => $emprunt,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a emprunt entity.
     *
     */
    public function deleteAction(Request $request, Emprunt $emprunt)
    {
        $form = $this->createDeleteForm($emprunt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($emprunt);
            $em->flush();
        }

        return $this->redirectToRoute('emprunt_index');
    }
    public function delete1Action(Emprunt $id)
    {
        $em = $this->getDoctrine() ->getRepository('EmpruntBundle:Emprunt')->findBy($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($id);
        $em->flush();
        return $this->redirectToRoute('emprunt_index');
    }

    function rechercherAction(Request $request){

        if ($request->isMethod('GET')) {
            $em = $this->getDoctrine()->getManager();
            $serie = $request->get('id');
            $voitures = $em->getRepository("EmpruntBundle:Emprunt")->rechercheParId($serie);
            if (empty($voitures)) {
                return $this->redirectToRoute('emprunt_index',array('cntrl'));
            } else {
                foreach ($voitures as $v) {

                    echo $v->getId();

                    return $this->redirectToRoute('emprunt_edit', array('id' => $v->getId()));
                }
            }
        }
        return $this->redirectToRoute('emprunt_index');

    }


    /**
     * Creates a form to delete a emprunt entity.
     *
     * @param Emprunt $emprunt The emprunt entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Emprunt $emprunt)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('emprunt_delete', array('id' => $emprunt->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
    public function deleteFromIndexAction(Emprunt $id)
    {


        $em = $this->getDoctrine()->getManager();
        $post=$em->getRepository('EmpruntBundle:Emprunt')->find($id);
        //$em->remove($auteur);

        $em->remove($post);
        $em->flush();
        $this->addFlash('message','emprunt supprime avec succes ');


        return $this->redirectToRoute('emprunt_index');
    }

/////////////********************CLIENT*********************************\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    public function indexClientAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if ($request->isMethod('GET')) {
            $em = $this->getDoctrine()->getManager();

        }

        $emprunts = $em->getRepository('EmpruntBundle:Emprunt')->findBy(['emprunter'=>0]);

        return $this->render('empruntClient/index.html.twig', array(
            'emprunts' => $emprunts,
        ));

    }

    public function newClientAction(Request $request)
    {
        $emprunt = new Emprunt();
        $form = $this->createForm('EmpruntBundle\Form\EmpruntType', $emprunt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($emprunt);
            $em->flush();

            return $this->redirectToRoute('emprunt_showClient', array('id' => $emprunt->getId()));
        }

        return $this->render('empruntClient/new.html.twig', array(
            'emprunt' => $emprunt,
            'form' => $form->createView(),
        ));
    }

    public function showClientAction(Emprunt $emprunt)
    {
        $deleteForm = $this->createDeleteForm($emprunt);

        return $this->render('empruntClient/show.html.twig', array(
            'emprunt' => $emprunt,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    public function editClientAction(Request $request, Emprunt $emprunt)
    {
        $deleteForm = $this->createDeleteForm($emprunt);
        $editForm = $this->createForm('EmpruntBundle\Form\EmpruntType', $emprunt);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('emprunt_editClient', array('id' => $emprunt->getId()));
        }

        return $this->render('empruntClient/edit.html.twig', array(
            'emprunt' => $emprunt,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    public function deleteClientAction(Request $request, Emprunt $emprunt)
    {
        $form = $this->createDeleteForm($emprunt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($emprunt);
            $em->flush();
        }

        return $this->redirectToRoute('emprunt_indexClient');
    }
    public function delete1ClientAction(Emprunt $id)
    {
        $em = $this->getDoctrine() ->getRepository('EmpruntBundle:Emprunt')->findBy($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($id);
        $em->flush();
        return $this->redirectToRoute('emprunt_indexClient');
    }
    function rechercherClientAction(Request $request){

        if ($request->isMethod('GET')) {
            $em = $this->getDoctrine()->getManager();
            $serie = $request->get('id');
            $voitures = $em->getRepository("EmpruntBundle:Emprunt")->rechercheParId($serie);
            if (empty($voitures)) {
                return $this->redirectToRoute('emprunt_indexClient',array('cntrl'));
            } else {
                foreach ($voitures as $v) {

                    echo $v->getId();

                    return $this->redirectToRoute('emprunt_editClient', array('id' => $v->getId()));
                }
            }
        }
        return $this->redirectToRoute('emprunt_indexClient');

    }
    public function deleteFromIndexClientAction(Emprunt $id)
    {


        $em = $this->getDoctrine()->getManager();
        $post=$em->getRepository('EmpruntBundle:Emprunt')->find($id);
        //$em->remove($auteur);

        $em->remove($post);
        $em->flush();
        $this->addFlash('message','emprunt supprime avec succes ');


        return $this->redirectToRoute('emprunt_indexClient');
    }
    public function EmprunterAction($id){
        $em = $this->getDoctrine()->getManager();


        $emprunts = $em->getRepository('EmpruntBundle:Emprunt')->findBy(['emprunter'=>1]);
        $var=count($emprunts);
        if($var>=2){
            return $this->render('empruntClient/index.html.twig',array('var1'=>$var,'emprunts' => $emprunts));
        }else {
            $query = "Update emprunt set Emprunter=1 where id=$id ";

            $statement = $em->getConnection()->prepare($query);
            $statement->execute();
            return $this->redirectToRoute('emprunt_indexClient');
        }
    }
    public function indexClient2Action(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if ($request->isMethod('GET')) {
            $em = $this->getDoctrine()->getManager();

        }

        $emprunts = $em->getRepository('EmpruntBundle:Emprunt')->findBy(['emprunter'=>1]);
        $var=count($emprunts);
        return $this->render('empruntClient/index2.html.twig', array(
            'emprunts' => $emprunts,
            'count'=>$var,
        ));

    }
    public function RendreAction($id){
        $em = $this->getDoctrine()->getManager();
        $query = "Update emprunt set Emprunter=0 where id=$id ";

        $statement = $em->getConnection()->prepare($query);
        $statement->execute();
        return $this->redirectToRoute('emprunt_indexClient');

    }
    public function showClient2Action(Emprunt $emprunt)
    {
        $deleteForm = $this->createDeleteForm($emprunt);

        return $this->render('empruntClient/show2.html.twig', array(
            'emprunt' => $emprunt,
            'delete_form' => $deleteForm->createView(),
        ));
    }

}
