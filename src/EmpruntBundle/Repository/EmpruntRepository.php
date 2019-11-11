<?php
/**
 * Created by PhpStorm.
 * User: Hamza
 * Date: 27/11/2018
 * Time: 18:22
 */

namespace EmpruntBundle\Repository;


use Doctrine\ORM\EntityRepository;

class EmpruntRepository extends EntityRepository
{
    public function rechercheParId($serie)
    {
        $req = $this->getEntityManager();
        return $req->createQuery
        ("select v from EmpruntBundle:Emprunt v where v.nomlivre like :s ")

            ->setParameter('s', $serie . '%')
            ->getResult();
    }
    public function compter(){
        $req = $this->getEntityManager();
        return $req->createQuery
        ("Select v.nomlivre ,v.id,v.nomauteur ,count (v.nomlivre) as nb  from EmpruntBundle:Emprunt v group by v.nomlivre order by nb desc")
        ->getResult();
    }
    public function Emprunter(){
        $em = $this->getDoctrine()->getManager();

        $em = $this->getDoctrine()->getManager();

        $query = "Select * from emprunt where Emprunter=0 ";

        $statement = $em->getConnection()->prepare($query);
        $statement->execute();
        $emprunts = $statement->fetchAll();
        return $emprunts;

    }
}