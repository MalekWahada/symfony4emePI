<?php

namespace EmpruntBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Emprunt
 *
 * @ORM\Table(name="emprunt")
 * @ORM\Entity(repositoryClass="EmpruntBundle\Repository\EmpruntRepository");
 */
class Emprunt
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
     * @ORM\Column(name="NomLivre", type="string", length=50, nullable=false)
     */
    private $nomlivre;

    /**
     * @var string
     *
     * @ORM\Column(name="NomAuteur", type="string", length=20, nullable=false)
     */
    private $nomauteur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="UserName", type="string", length=20, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=false)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="Email", type="string", length=50, nullable=false)
     */
    private $email;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Emprunter", type="boolean", nullable=true)
     */
    private $emprunter = '0';

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNomlivre()
    {
        return $this->nomlivre;
    }

    /**
     * @param string $nomlivre
     */
    public function setNomlivre($nomlivre)
    {
        $this->nomlivre = $nomlivre;
    }

    /**
     * @return string
     */
    public function getNomauteur()
    {
        return $this->nomauteur;
    }

    /**
     * @param string $nomauteur
     */
    public function setNomauteur($nomauteur)
    {
        $this->nomauteur = $nomauteur;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return bool
     */
    public function isEmprunter()
    {
        return $this->emprunter;
    }

    /**
     * @param bool $emprunter
     */
    public function setEmprunter($emprunter)
    {
        $this->emprunter = $emprunter;
    }




}

