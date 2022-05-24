<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $program = new Program();
        $program->setTitle('Walking dead');
        $program->setSynopsis('Des zombies envahissent la terre');
        $program->setCategory($this->getReference('category_Action'));
        $manager->persist($program);
        $program = new Program();
        $program->setTitle('Pokemon');
        $program->setSynopsis('Sacha est un jeune garçon qui vit dans le monde des pokemon. Un pokemon est une petite créature possédant divers pouvoirs. Le but de Sacha est de devenir maitre pokemon. Entouré de ses amis il va vivre de nombreuses aventures et combattre la Team Rocket, des voleurs de pokemon.');
        $program->setCategory($this->getReference('category_Animation'));
        $manager->persist($program);
        $program = new Program();
        $program->setTitle('The haunting of hill house');
        $program->setSynopsis('Plusieurs frères et sœurs qui, enfants, ont grandi dans la demeure qui allait devenir la maison hantée la plus célèbre des États-Unis sont contraints de se retrouver pour faire face à cette tragédie ensemble.');
        $program->setCategory($this->getReference('category_Horreur'));
        $manager->persist($program);
        $program = new Program();
        $program->setTitle('The Witcher');
        $program->setSynopsis(' Inspiré d\'une série littéraire fantastique à succès, The Witcher est un récit épique sur la famille et le destin. Geralt de Riv, un chasseur de monstres solitaire, se bat pour trouver sa place dans un monde où les humains sont souvent plus vicieux que les bêtes.');
        $program->setCategory($this->getReference('category_Fantastique'));
        $manager->persist($program);
        $program = new Program();
        $program->setTitle('Walking dead');
        $program->setSynopsis(' Dans les Outer Banks en Caroline du Nord, une bande d\'adolescents appelée « Pogues » est déterminée à savoir pourquoi le père de John B (Chase Stokes)a mystérieusement disparu et, peu à peu ils découvrent le trésor légendaire qu\'il avait commencé à chercher…');
        $program->setCategory($this->getReference('category_Aventure'));
        $manager->persist($program);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
