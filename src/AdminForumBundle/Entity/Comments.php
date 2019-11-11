<?php

namespace AdminForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comments
 *
 * @ORM\Table(name="comments", indexes={@ORM\Index(name="idUser", columns={"idUser"}), @ORM\Index(name="idTopic", columns={"idTopic"})})
 * @ORM\Entity
 */
class Comments
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcmmt", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcmmt;

    /**
     * @var integer
     *
     * @ORM\Column(name="idUser", type="integer", nullable=false)
     */
    private $iduser;

    /**
     * @var string
     *
     * @ORM\Column(name="cmmt", type="string", length=500, nullable=false)
     */
    private $cmmt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timecmmt", type="datetime", nullable=false)
     */
    private $timecmmt;

    /**
     * @var integer
     *
     * @ORM\Column(name="nblikes", type="integer", nullable=false)
     */
    private $nblikes;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbsignal", type="integer", nullable=false)
     */
    private $nbsignal;

    /**
     * @var \Topic
     *
     * @ORM\ManyToOne(targetEntity="Topic")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idTopic", referencedColumnName="idTopic")
     * })
     */
    private $idtopic;

    /**
     * @return int
     */
    public function getIdcmmt()
    {
        return $this->idcmmt;
    }

    /**
     * @param int $idcmmt
     */
    public function setIdcmmt($idcmmt)
    {
        $this->idcmmt = $idcmmt;
    }

    /**
     * @return int
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * @param int $iduser
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;
    }

    /**
     * @return string
     */
    public function getCmmt()
    {
        return $this->cmmt;
    }

    /**
     * @param string $cmmt
     */
    public function setCmmt($cmmt)
    {
        $this->cmmt = $cmmt;
    }

    /**
     * @return \DateTime
     */
    public function getTimecmmt()
    {
        return $this->timecmmt;
    }

    /**
     * @param \DateTime $timecmmt
     */
    public function setTimecmmt($timecmmt)
    {
        $this->timecmmt = $timecmmt;
    }

    /**
     * @return int
     */
    public function getNblikes()
    {
        return $this->nblikes;
    }

    /**
     * @param int $nblikes
     */
    public function setNblikes($nblikes)
    {
        $this->nblikes = $nblikes;
    }

    /**
     * @return int
     */
    public function getNbsignal()
    {
        return $this->nbsignal;
    }

    /**
     * @param int $nbsignal
     */
    public function setNbsignal($nbsignal)
    {
        $this->nbsignal = $nbsignal;
    }

    /**
     * @return \Topic
     */
    public function getIdtopic()
    {
        return $this->idtopic;
    }

    /**
     * @param \Topic $idtopic
     */
    public function setIdtopic($idtopic)
    {
        $this->idtopic = $idtopic;
    }


}

