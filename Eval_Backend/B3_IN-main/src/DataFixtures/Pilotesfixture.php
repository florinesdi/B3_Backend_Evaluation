<?php

namespace App\DataFixtures;

use App\Entity\Pilote;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;

class PiloteFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $ecuries = [
            'Scuderia Ferrari',
            'Mercedes-AMG Petronas',
            'Red Bull Racing',
            'Alpine F1 Team',
        ];

        foreach ($ecuries as $ecurieNom) {
            for ($i = 1; $i <= 3; $i++) {
                $pilote = new Pilote();
                $pilote->setPrenom($faker->firstName());
                $pilote->setNom($faker->lastName());
                $pilote->setPointsLicence(12);
                $pilote->setDateDebutF1($faker->dateTimeBetween('-10 years', 'now'));
                $pilote->setStatut($i === 1 ? 'titulaire' : 'réserviste');
                $pilote->setEcurie($this->getReference('ecurie' . $ecurieNom));

                $manager->persist($pilote);

                // On garde une référence pour les infractions
                $this->addReference('pilote_' . $ecurieNom . '_' . $i, $pilote);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [EcurieFixtures::class];
    }
}
