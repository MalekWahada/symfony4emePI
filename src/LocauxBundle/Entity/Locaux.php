<?php

namespace LocauxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Locaux
 *
 * @ORM\Table(name="locaux")
 * @ORM\Entity
 */
class Locaux
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idLoc", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idloc;

    /**
     * @var string
     *
     * @ORM\Column(name="adrs", type="text", length=65535, nullable=true)
     */
    private $adrs;

    /**
     * @var float
     *
     * @ORM\Column(name="Xs", type="float", precision=10, scale=0, nullable=true)
     */
    private $xs;

    /**
     * @var float
     *
     * @ORM\Column(name="Ys", type="float", precision=10, scale=0, nullable=true)
     */
    private $ys;

    /**
     * @return int
     */
    public function getIdloc()
    {
        return $this->idloc;
    }

    /**
     * @param int $idloc
     */
    public function setIdloc($idloc)
    {
        $this->idloc = $idloc;
    }

    /**
     * @return string
     */
    public function getAdrs()
    {
        return $this->adrs;
    }

    /**
     * @param string $adrs
     */
    public function setAdrs($adrs)
    {
        $this->adrs = $adrs;
    }

    /**
     * @return float
     */
    public function getXs()
    {
        return $this->xs;
    }

    /**
     * @param float $xs
     */
    public function setXs($xs)
    {
        $this->xs = $xs;
    }

    /**
     * @return float
     */
    public function getYs()
    {
        return $this->ys;
    }

    /**
     * @param float $ys
     */
    public function setYs($ys)
    {
        $this->ys = $ys;
    }


}

