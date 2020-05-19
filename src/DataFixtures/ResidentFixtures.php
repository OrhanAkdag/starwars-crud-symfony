<?php

namespace App\DataFixtures;

use App\Entity\Planete;
use App\Entity\Resident;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ResidentFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $planet = $manager->getRepository(Planete::class)->findOneBy(['nom'=>'Terre']);

        $resident = new Resident();
        $resident->setFirstname('Aurélien');
        $resident->setLastname('Delorme');
        $resident->setPlanete($planet);

        $manager->persist($resident);
        $manager->flush();

    }

    public function getDependencies()
    {
        return array(
            PlanetsFixtures::class,
        );
    }

}