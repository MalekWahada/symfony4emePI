<?php

namespace AdminForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Topic
 *
 * @ORM\Table(name="topic", indexes={@ORM\Index(name="idUser", columns={"idUser"}), @ORM\Index(name="idUser_2", columns={"idUser"}), @ORM\Index(name="idTopic", columns={"idTopic"})})
 * @ORM\Entity
 */
class Topic
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idTopic", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtopic;

    /**
     * @var integer
     *
     * @ORM\Column(name="idUser", type="integer", nullable=false)
     */
    private $iduser;

    /**
     * @var string
     *
     * @ORM\Column(name="TopicName", type="string", length=500, nullable=false)
     */
    private $topicname;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timeTopic", type="datetime", nullable=false)
     */
    private $timetopic;


}

