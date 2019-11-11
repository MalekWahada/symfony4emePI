<?php
/**
 * Created by PhpStorm.
 * User: Hamza
 * Date: 28/11/2018
 * Time: 00:10
 */

function rechercherAction(Request $request){

    if ($request->isMethod('GET')) {
        $em = $this->getDoctrine()->getManager();
        $serie = $request->get('id');
        $voitures = $em->getRepository("EmpruntBundle:Emprunt")->rechercheParId($serie);
        foreach ($voitures as $v) {

            echo $v->getId();

            return $this->redirectToRoute('emprunt_edit', array('id' => $v->getId()));
        }
    }
    return $this->render('emprunt_index');
}
?>