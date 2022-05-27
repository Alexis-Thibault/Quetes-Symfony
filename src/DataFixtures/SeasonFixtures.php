<?php

namespace App\DataFixtures;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Season;
use Faker\Factory;


class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i = 0; $i <= 10; $i++) {
            $season = new Season();
            //Ce Faker va nous permettre d'alimenter l'instance de Season que l'on souhaite ajouter en base
            $season->setNumber($faker->numberBetween(1, 10));
            $season->setYear($faker->year());
            $season->setDescription($faker->paragraphs(3, true));
            $season->setProgram($this->getReference('program_' . $faker->numberBetween(1, 5)));
            $this->addReference('season_' . $i, $season);
            $manager->persist($season);
        }

        $manager->flush();  
    }

    public function getDependencies()
    {
        return [
            ProgramFixtures::class,
        ];
    }
}
