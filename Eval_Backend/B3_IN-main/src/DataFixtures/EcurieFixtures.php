<?php

namespace App\DataFixtures;

use App\Entity\Ecurie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EcurieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $ecuriesData = [
            ['Name' => 'Ferrari', 'Car' => 'F1-75'],
            ['Name' => 'Mercedes', 'Car' => 'W14'],
            ['Name' => 'Red Bull', 'Car' => 'RB19'],
        ];

        foreach ($ecuriesData as $data) {
            $ecurie = new Ecurie();
            $ecurie->setName($data['Name']);
            $ecurie->setCar($data['Car']);

            $manager->persist($ecurie);

            // Référence pour les pilotes et infractions
            $this->addReference('ecurie_' . str_replace(' ', '_', $data['Name']), $ecurie);
        }

        $manager->flush();
    }
}
