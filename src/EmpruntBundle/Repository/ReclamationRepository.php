<?php
/**
 * Created by PhpStorm.
 * User: Hamza
 * Date: 27/11/2018
 * Time: 18:22
 */

namespace EmpruntBundle\Repository;


use Doctrine\ORM\EntityRepository;

class ReclamationRepository extends EntityRepository
{
    public function rechercheParId($serie)
    {
        $req = $this->getEntityManager();
        return $req->createQuery
        ("select v from EmpruntBundle:Reclamation v where v.nomlivre like :s ")

            ->setParameter('s', $serie . '%')
            ->getResult();
    }
    public function compter(){
        $req = $this->getEntityManager();
        return $req->createQuery
        ("Select v.nomlivre ,v.id,v.nomauteur ,count (v.nomlivre) as nb  from EmpruntBundle:Emprunt v group by v.nomlivre")
        ->getResult();
    }

}