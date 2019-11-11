<?php

namespace LivreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Livres
 *
 * @ORM\Table(name="livres")
 * @ORM\Entity
 */
class Livres
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *  @Assert\Length(
     *      min = 3,
     *      max = 100,
     *      minMessage = "le nom  du livre doit avoir au moin  {{ limit }} caratéres",
     *      maxMessage = "le nom de livre  ne doit pas depasser 100{{ limit }} caratére"
     * )
     *@Assert\NotBlank(message="Ce champ ne doit pas etre vide ")
     * @ORM\Column(name="nom", type="text", length=16777215, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *  @Assert\Length(
     *      min = 3,
     *      max = 100,
     *      minMessage = "le nom de l'auteur du livre doit avoir au moin  {{ limit }} caratéres",
     *      maxMessage = "le nom de livre  ne doit pas depasser 100{{ limit }} caratére"
     * )
     *@Assert\NotBlank(message="Ce champ ne doit pas etre vide ")
     * @ORM\Column(name="auteur", type="text", length=16777215, nullable=false)
     */
    private $auteur;

    /**
     * @var string
     *
     * @ORM\Column(name="codeQR", type="text", length=16777215, nullable=false)
     */
    private $codeqr;

    /**
     * @var string
     * @Assert\NotBlank(message="Ce champ ne doit pas etre vide ")
     * @ORM\Column(name="categorie", type="text", length=16777215, nullable=false)
     */
    private $categorie;

    /**
     * @var string
     * @Assert\Length(
     *      min = 3,
     *      max = 100,
     *      minMessage = "le nom de la maison de publication du livre doit avoir au moin  {{ limit }} caratéres",
     *      maxMessage = "le nom de livre  ne doit pas depasser 100{{ limit }} caratére"
     * )
     * @ORM\Column(name="M_Pub", type="text", length=16777215, nullable=false)
     */
    private $mPub;

    /**
     * @var string
     *@Assert\NotBlank(message="Ce champ ne doit pas etre vide ")
     * @ORM\Column(name="img", type="text", length=16777215, nullable=false)
     */
    private $img;

    /**
     * @var string
     * @Assert\Length(
     *      min = 10,
     *      max = 100,
     *      minMessage = "le discription du  livre doit avoir au moin  {{ limit }} caratéres",
     *      maxMessage = "le nom de livre  ne doit pas depasser 100{{ limit }} caratére"
     * )
     * @ORM\Column(name="description", type="text", length=16777215, nullable=false)
     */
    private $description;
    /**
     * @var float
     *  @Assert\Range(
     *      min = 0,
     *      max = 10000,
     *      minMessage = "le prix  des livres ne peux pas etre  negative  ",
     *      maxMessage = "le prix de livre commandé ne doit pas depasser  {{ limit }}"
     * )
     *@Assert\NotBlank(message="Ce champ ne doit pas etre vide ")
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=false)
     */
    private $prix;

    /**
     * @var integer
     * @Assert\Range(
     *      min = 0,
     *      max = 100,
     *      minMessage = "le stock  des livres ne peux pas etre  negative  ",
     *      maxMessage = "le stock du livre commandé ne doit pas depasser {{ limit }}"
     * )
     *@Assert\NotBlank(message="Ce champ ne doit pas etre vide ")
     * @ORM\Column(name="stock", type="integer", nullable=false)
     */
    private $stock;

    /**
     * @var string
     *
     *@Assert\Valid()
     * @ORM\Column(name="pdfPath", type="text", length=65535, nullable=true)
     */
    private $pdfpath;

    /**
     * @Assert\Valid()
     * @var string
     *
     * @ORM\Column(name="mp3Path", type="text", length=65535, nullable=true)
     */
    private $mp3path;

    /**
     * @Assert\Range(
     *      min = 0,
     *      max = 5,
     *      minMessage = "vous ne pouvez pas donné une note moin que  {{ limit }}",
     *      maxMessage = "vous ne pouvez pas donné une note plus que {{ limit }}"
     * )
     * @Assert\NotBlank(message="Ce champ ne doit pas etre vide ")
     * @var float
     * @ORM\Column(name="rate", type="float", nullable=false)
     */
    private $rate;
    /**
     * @Assert\Valid()
     * @var promo
     * @ORM\OneToOne(targetEntity="LivreBundle\Entity\promo",cascade={"persist","remove"})
     */
    private $promo;
    /**
     * @return promo
     */
    public function getPromo()
    {
        return $this->promo;
    }

    /**
     * @param promo $promo
     */
    public function setPromo($promo)
    {
        $this->promo = $promo;
    }

    /**
     *
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
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * @param string $auteur
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
    }

    /**
     * @return string
     */
    public function getCodeqr()
    {
        return $this->codeqr;
    }

    /**
     * @param string $codeqr
     */
    public function setCodeqr($codeqr)
    {
        $this->codeqr = $codeqr;
    }

    /**
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param string $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    /**
     * @return string
     */
    public function getMPub()
    {
        return $this->mPub;
    }

    /**
     * @param string $mPub
     */
    public function setMPub($mPub)
    {
        $this->mPub = $mPub;
    }

    /**
     * @return float
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * @param float $rate
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
    }

    /**
     * @return string
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param string $img
     */
    public function setImg($img)
    {
        $this->img = $img;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param float $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    /**
     * @return int
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param int $stock
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    /**
     * @return string
     */
    public function getPdfpath()
    {
        return $this->pdfpath;
    }

    /**
     * @param string $pdfpath
     */
    public function setPdfpath($pdfpath)
    {
        $this->pdfpath = $pdfpath;
    }

    /**
     * @return string
     */
    public function getMp3path()
    {
        return $this->mp3path;
    }

    /**
     * @param string $mp3path
     */
    public function setMp3path($mp3path)
    {
        $this->mp3path = $mp3path;
    }


public function showallLivres(){
    $livres=$this->getDoctrine()
        ->getRepository('LivreBundle:Livres')
        ->findALL();
    return new Response($livres);
}


}
