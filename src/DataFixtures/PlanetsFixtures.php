<?php

namespace App\DataFixtures;

use App\Entity\Planete;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PlanetsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $planet = new Planete();
        $planet->setAllegiance('Toto');
        $planet->setDescription('Super planette');
        $planet->setDeteDecouverte(new \DateTime());
        $planet->setNbKmTerre(100);
        $planet->setNom('Terre');
        $planet->setTerrain('Cailloux');

        $manager->persist($planet);
        $manager->flush();

        $planet = new Planete();
        $planet->setAllegiance('tata');
        $planet->setDescription('Une autre super planette');
        $planet->setDeteDecouverte(new \DateTime());
        $planet->setNbKmTerre(500);
        $planet->setNom('Pluton');
        $planet->setTerrain('Sable');

        $manager->persist($planet);
        $manager->flush();
    }
}