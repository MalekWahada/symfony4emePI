<?php

namespace EmpruntBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Maisonedition
 *
 * @ORM\Table(name="maisonedition")
 * @ORM\Entity
 */
class Maisonedition
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="text", length=65535, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="nationalite", type="text", length=65535, nullable=false)
     */
    private $nationalite;

    /**
     * @var string
     *
     * @ORM\Column(name="groupeEditoriel", type="text", length=65535, nullable=false)
     */
    private $groupeeditoriel;

    /**
     * @var string
     *
     * @ORM\Column(name="proprietaire", type="text", length=65535, nullable=false)
     */
    private $proprietaire;


}

