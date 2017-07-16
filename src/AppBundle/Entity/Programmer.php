<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Programmer
 *
 * @ORM\Table(name="programmer")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProgrammerRepository")
 */
class Programmer
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, unique=true)
     */
    private $nickname;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $avatarNumber;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tagLine;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $powerLevel = 0;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function __construct($nickname = null, $avatarNumber = null)
    {
        $this->nickname = $nickname;
        $this->avatarNumber = $avatarNumber;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nickname
     *
     * @param string $nickname
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
    }

    /**
     * Get nickname
     *
     * @return string
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Set avatarNumber
     *
     * @param integer $avatarNumber
     */
    public function setAvatarNumber($avatarNumber)
    {
        $this->avatarNumber = $avatarNumber;
    }

    /**
     * Get avatarNumber
     *
     * @return int
     */
    public function getAvatarNumber()
    {
        return $this->avatarNumber;
    }

    /**
     * Set tagLine
     *
     * @param string $tagLine
     */
    public function setTagLine($tagLine)
    {
        $this->tagLine = $tagLine;
    }

    /**
     * Get tagLine
     *
     * @return string
     */
    public function getTagLine()
    {
        return $this->tagLine;
    }

    /**
     * Set powerLevel
     *
     * @param integer $powerLevel
     */
    public function setPowerLevel($powerLevel)
    {
        $this->powerLevel = $powerLevel;
    }

    /**
     * Get powerLevel
     *
     * @return int
     */
    public function getPowerLevel()
    {
        return $this->powerLevel;
    }

    public function getUser()
    {
        return $this->user;
    }
}
