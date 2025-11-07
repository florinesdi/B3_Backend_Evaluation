<?php

namespace App\DataFixtures;

use App\Entity\Infraction;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;

class InfractionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // Quelques courses aléatoires
        $courses = ['Grand Prix de Monaco', 'Grand Prix de France', 'Grand Prix d’Italie', 'Grand Prix d’Espagne'];

        for ($i = 0; $i < 10; $i++) {
            $infraction = new Infraction();
            $infraction->setNomCourse($faker->randomElement($courses));
            $infraction->setDescription($faker->sentence(6));
            $infraction->setDate($faker->dateTimeBetween('-1 years', 'now'));

            // Type d’infraction : amende ou pénalité
            $isAmende = $faker->boolean(50);
            if ($isAmende) {
                $infraction->setType('amende');
                $infraction->setMontant($faker->numberBetween(1000, 100000));
                $infraction->setPoints(null);
            } else {
                $infraction->setType('pénalité');
                $infraction->setPoints($faker->numberBetween(1, 5));
                $infraction->setMontant(null);
            }

            // Ciblage : pilote OU écurie
            if ($faker->boolean(70)) {
                $ecurieNom = $faker->randomElement([
                    'Scuderia Ferrari',
                    'Mercedes-AMG Petronas',
                    'Red Bull Racing',
                    'Alpine F1 Team',
                ]);
                $piloteRef = 'pilote_' . $ecurieNom . '_' . $faker->numberBetween(1, 3);
                $infraction->setPilote($this->getReference($piloteRef));
            } else {
                $ecurieNom = $faker->randomElement([
                    'Scuderia Ferrari',
                    'Mercedes-AMG Petronas',
                    'Red Bull Racing',
                    'Alpine F1 Team',
                ]);
                $infraction->setEcurie($this->getReference('ecurie' . $ecurieNom));
            }

            $manager->persist($infraction);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [PiloteFixtures::class];
    }
}
