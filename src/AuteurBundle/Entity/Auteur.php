<?php

namespace AuteurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Auteur
 *
 * @ORM\Table(name="auteur")
 * @ORM\Entity
 */
class Auteur
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idautr", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idautr;

    /**
     * @var string
     *
     * @ORM\Column(name="authorName", type="string", length=30, nullable=true)
     */
    private $authorname;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthDate", type="date", nullable=false)
     */
    private $birthdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deathDate", type="date", nullable=false)
     */
    private $deathdate;

    /**
     * @var string
     *
     * @ORM\Column(name="contact", type="string", length=255, nullable=false)
     */
    private $contact;

    /**
     * @var string
     *
     * @ORM\Column(name="descrip", type="string", length=200, nullable=true)
     */
    private $descrip;

    /**
     * Auteur constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getIdautr()
    {
        return $this->idautr;
    }

    /**
     * @param int $idautr
     */
    public function setIdautr($idautr)
    {
        $this->idautr = $idautr;
    }

    /**
     * @return string
     */
    public function getAuthorname()
    {
        return $this->authorname;
    }

    /**
     * @param string $authorname
     */
    public function setAuthorname($authorname)
    {
        $this->authorname = $authorname;
    }

    /**
     * @return \DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * @param \DateTime $birthdate
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }

    /**
     * @return \DateTime
     */
    public function getDeathdate()
    {
        return $this->deathdate;
    }

    /**
     * @param \DateTime $deathdate
     */
    public function setDeathdate($deathdate)
    {
        $this->deathdate = $deathdate;
    }

    /**
     * @return string
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @param string $contact
     */
    public function setContact($contact)
    {
        $this->contact = $contact;
    }

    /**
     * @return string
     */
    public function getDescrip()
    {
        return $this->descrip;
    }

    /**
     * @param string $descrip
     */
    public function setDescrip($descrip)
    {
        $this->descrip = $descrip;
    }


}

