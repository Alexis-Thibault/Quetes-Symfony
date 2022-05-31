<?php

namespace App\DataFixtures;

use App\Entity\Program;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;


class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    private Slugify $slugify;

    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }
    
    public function load(ObjectManager $manager)
    {

        $faker = Factory::create();

        $program1 = new Program();
        $program1->setTitle('Walking dead');
        $program1->setSlug($this->slugify->generate($program1->getTitle()));
        $program1->setSynopsis('Des zombies envahissent la terre');
        $program1->setCategory($this->getReference('category_Action')); 
        $this->addReference('program_1',$program1);
        $manager->persist($program1);

        $program2 = new Program();
        $program2->setTitle('Pokemon');
        $program2->setSlug($this->slugify->generate($program2->getTitle()));
        $program2->setSynopsis('Sacha est un jeune garçon qui vit dans le monde des pokemon. Un pokemon est une petite créature possédant divers pouvoirs. Le but de Sacha est de devenir maitre pokemon. Entouré de ses amis il va vivre de nombreuses aventures et combattre la Team Rocket, des voleurs de pokemon.');
        $program2->setCategory($this->getReference('category_Animation'));
        $this->addReference('program_2', $program2);
        $manager->persist($program2);

        $program3 = new Program();
        $program3->setTitle('The haunting of hill house');
        $program3->setSlug($this->slugify->generate($program3->getTitle()));
        $program3->setSynopsis('Plusieurs frères et sœurs qui, enfants, ont grandi dans la demeure qui allait devenir la maison hantée la plus célèbre des États-Unis sont contraints de se retrouver pour faire face à cette tragédie ensemble.');
        $program3->setCategory($this->getReference('category_Horreur'));
        $this->addReference('program_3', $program3);
        $manager->persist($program3);

        $program4 = new Program();
        $program4->setTitle('The Witcher');
        $program4->setSlug($this->slugify->generate($program4->getTitle()));
        $program4->setSynopsis(' Inspiré d\'une série littéraire fantastique à succès, The Witcher est un récit épique sur la famille et le destin. Geralt de Riv, un chasseur de monstres solitaire, se bat pour trouver sa place dans un monde où les humains sont souvent plus vicieux que les bêtes.');
        $program4->setCategory($this->getReference('category_Fantastique'));
        $this->addReference('program_4', $program4);
        $manager->persist($program4);

        $program5 = new Program();
        $program5->setTitle('Outer Banks');
        $program5->setSlug($this->slugify->generate($program5->getTitle()));
        $program5->setSynopsis(' Dans les Outer Banks en Caroline du Nord, une bande d\'adolescents appelée « Pogues » est déterminée à savoir pourquoi le père de John B (Chase Stokes)a mystérieusement disparu et, peu à peu ils découvrent le trésor légendaire qu\'il avait commencé à chercher…');
        $program5->setCategory($this->getReference('category_Aventure'));
        $this->addReference('program_5', $program5);
        $manager->persist($program5);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
