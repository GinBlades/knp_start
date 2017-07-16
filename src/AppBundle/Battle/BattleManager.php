<?php

namespace AppBundle\Battle;

use AppBundle\Entity\Battle;
use AppBundle\Entity\Programmer;
use AppBundle\Entity\Project;
use Doctrine\ORM\EntityManager;

class BattleManager
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Creates epic battle
     * @param  Programmer $programmer
     * @param  Project    $project
     * @return Battle
     */
    public function battle(Programmer $programmer, Project $project)
    {
        $battle = new Battle($programmer, $project);

        if ($programmer->getPowerLevel() < $project->getDifficultyLevel()) {
            // not enough energy
            $battle->setBattleLostByProgrammer(
                'You need to power up.'
            );
        } else {
            if (rand(0, 2) != 2) {
                $battle->setBattleWonByProgrammer(
                    'You are a hero!'
                );
            } else {
                $battle->setBattleLostByProgrammer('Project failed :(');
            }
            $programmer->setPowerLevel($programmer->getPowerLevel() - $project->getDifficultyLevel());
        }

        $this->em->persist($battle);
        $this->em->persist($programmer);
        $this->em->flush();

        return $battle;
    }
}
