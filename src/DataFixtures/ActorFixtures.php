<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;
use App\Entity\Actor;
use App\Entity\Program;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $programs = $manager->getRepository(Program::class)->findAll();

        for ($i = 0; $i <= 10; $i++) {
            $actor = new Actor();
            $actor->setName($faker->name());
            for ($j = 0; $j < 4; $j++) {
                $actor->addProgram($faker->randomElement($programs));
            }
            $this->addReference('actor_' . $i, $actor);
            $manager->persist($actor);
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
