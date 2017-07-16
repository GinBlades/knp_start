<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Battle
 *
 * @ORM\Table(name="battle")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BattleRepository")
 */
class Battle
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
     * @ORM\ManyToOne(targetEntity="Programmer")
     * @ORM\JoinColumn(nullable=false)
     */
    private $programmer;

    /**
     * @ORM\ManyToOne(targetEntity="Project")
     * @ORM\JoinColumn(nullable=false)
     */
    private $project;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $didProgrammerWin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $foughtAt;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $notes;

    public function __construct(Programmer $programmer, Project $project)
    {
        $this->programmer = $programmer;
        $this->project = $project;
        $this->foughtAt = new \DateTime();
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
     * Set didProgrammerWin
     *
     * @param boolean $didProgrammerWin
     */
    public function setDidProgrammerWin($didProgrammerWin)
    {
        $this->didProgrammerWin = $didProgrammerWin;
    }

    /**
     * Get didProgrammerWin
     *
     * @return bool
     */
    public function getDidProgrammerWin()
    {
        return $this->didProgrammerWin;
    }

    /**
     * Set foughtAt
     *
     * @param \DateTime $foughtAt
     */
    public function setFoughtAt($foughtAt)
    {
        $this->foughtAt = $foughtAt;
    }

    /**
     * Get foughtAt
     *
     * @return \DateTime
     */
    public function getFoughtAt()
    {
        return $this->foughtAt;
    }

    /**
     * Set notes
     *
     * @param string $notes
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

    /**
     * Get notes
     *
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    public function getProject()
    {
        return $this->project;
    }

    public function getProgrammer()
    {
        return $this->programmer;
    }

    public function setBattleWonByProgrammer($notes)
    {
        $this->didProgrammerWin = true;
        $this->notes = $notes;
    }

    public function setBattleLostByProgrammer($notes)
    {
        $this->didProgrammerWin = false;
        $this->notes = $notes;
    }
}
