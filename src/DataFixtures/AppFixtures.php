<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Event;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
      $faker = Factory::create('fr_FR');
      
      for ($e=0; $e < 5; $e++) { 
          $event = new Event;
          $event->setName($faker->name())
                ->setDescription($faker->paragraph())
                ->setPrice($faker->randomFloat(2,20,100))
                ->setLocation($faker->randomElement(['paris','lyon','genève']))
                ->setStartsAt($faker->dateTimeBetween('- 1 months'));

          $manager->persist($event);
        }

        $manager->flush();
    }
}
