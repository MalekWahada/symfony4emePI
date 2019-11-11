<?php

namespace EchangeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Echange
 *
 * @ORM\Table(name="echange")
 * @ORM\Entity
 */
class Echange
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idech", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idech;

    /**
     * @var string
     *
     * @ORM\Column(name="idprop", type="text", length=65535, nullable=false)
     */
    private $idprop;

    /**
     * @var string
     *
     * @ORM\Column(name="iddem", type="text", length=65535, nullable=false)
     */
    private $iddem;

    /**
     * @var string
     *
     * @ORM\Column(name="stat", type="text", length=65535, nullable=false)
     */
    private $stat;

    /**
     * @var string
     *
     * @ORM\Column(name="descr", type="text", length=65535, nullable=false)
     */
    private $descr;

    /**
     * @var integer
     *
     * @ORM\Column(name="numcontact", type="integer", nullable=false)
     */
    private $numcontact;

    /**
     * @var string
     *
     * @ORM\Column(name="lieuech", type="text", length=65535, nullable=false)
     */
    private $lieuech;

    /**
     * @return int
     */
    public function getIdech()
    {
        return $this->idech;
    }

    /**
     * @param int $idech
     */
    public function setIdech($idech)
    {
        $this->idech = $idech;
    }

    /**
     * @return string
     */
    public function getIdprop()
    {
        return $this->idprop;
    }

    /**
     * @param string $idprop
     */
    public function setIdprop($idprop)
    {
        $this->idprop = $idprop;
    }

    /**
     * @return string
     */
    public function getIddem()
    {
        return $this->iddem;
    }

    /**
     * @param string $iddem
     */
    public function setIddem($iddem)
    {
        $this->iddem = $iddem;
    }

    /**
     * @return string
     */
    public function getStat()
    {
        return $this->stat;
    }

    /**
     * @param string $stat
     */
    public function setStat($stat)
    {
        $this->stat = $stat;
    }

    /**
     * @return string
     */
    public function getDescr()
    {
        return $this->descr;
    }

    /**
     * @param string $descr
     */
    public function setDescr($descr)
    {
        $this->descr = $descr;
    }

    /**
     * @return int
     */
    public function getNumcontact()
    {
        return $this->numcontact;
    }

    /**
     * @param int $numcontact
     */
    public function setNumcontact($numcontact)
    {
        $this->numcontact = $numcontact;
    }

    /**
     * @return string
     */
    public function getLieuech()
    {
        return $this->lieuech;
    }

    /**
     * @param string $lieuech
     */
    public function setLieuech($lieuech)
    {
        $this->lieuech = $lieuech;
    }
    public function __toString() {
        return (string)$this->lieuech;

    }
}

