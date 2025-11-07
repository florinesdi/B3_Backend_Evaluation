<?php

namespace App\DataFixtures;

use App\Entity\Ecurie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EcurieFixtures extends Fixture
{
    public const ECURIES = [
        'Scuderia Ferrari',
        'Mercedes-AMG Petronas',
        'Red Bull Racing',
        'Alpine F1 Team',
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::ECURIES as $nom) {
            $ecurie = new Ecurie();
            $ecurie->setNom($nom);

            $manager->persist($ecurie);

            $this->addReference('ecurie' . $nom, $ecurie);
        }

        $manager->flush();
    }
}
