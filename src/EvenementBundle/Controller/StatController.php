<?php
/**
 * Created by PhpStorm.
 * User: MBM info
 * Date: 26/11/2018
 * Time: 16:59
 */

namespace EvenementBundle\Controller;

use EvenementBundle\Entity\Event;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


class StatController extends Controller
{
    public function StatAction()
    {

        $ob = new Highchart();
        $ob->chart->renderTo('linechart');
        $ob->title->text('Browser market shares at a specific website in 2010');
        $ob->plotOptions->pie(array(
            'allowPointSelect' => true,
            'cursor' => 'pointer',
            'dataLabels' => array('enabled' => false),
            'showInLegend' => true
        ));
        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery('SELECT AVG(e.nbreParticipant) as Participants, e.nom as Nom FROM EvenementBundle:Event e group by e.nom ');
        $resultat = $query->getResult();
        var_dump($resultat);
        $data = array();
        foreach ($resultat as $values)
        {

            $a = array($values['Nom'],intval($values['Participants']));
            array_push($data,$a);
        }


        $ob->series(array(array('type' => 'pie', 'name' => 'Browser share', 'data' => $data)));

        return $this->render('@Evenement\Default\Stat.html.twig', array(
            'chart' => $ob
        ));
    }
}