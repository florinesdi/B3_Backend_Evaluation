<?php

namespace App\DataFixtures;

use App\Entity\Infraction;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class InfractionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $infractions = [
            ['Grand Prix de Monaco', 'CharlesLeclerc', null, 'Excès de vitesse dans les stands', 3, null, '2024-05-26'],
            ['Grand Prix de France', null, 'Alpine F1 Team', 'Non-respect du règlement technique', null, 5000, '2024-07-21'],
            ['Grand Prix d’Italie', 'LewisHamilton', null, 'Accrochage avec un autre pilote', 2, null, '2024-09-08'],
        ];

        foreach ($infractions as [$course, $piloteRef, $ecurieNom, $description, $penalite, $amende, $date]) {
            $infraction = new Infraction();
            $infraction->setCourse($course);
            $infraction->setDescription($description);
            $infraction->setDate(new \DateTime($date));
            $infraction->setPenalitePoints($penalite);
            $infraction->setAmendeEuros($amende);

            if ($piloteRef) {
                $infraction->setPilote($this->getReference('pilote' . $piloteRef));
            }

            if ($ecurieNom) {
                $infraction->setEcurie($this->getReference('ecurie' . $ecurieNom));
            }

            $manager->persist($infraction);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [PiloteFixtures::class, EcurieFixtures::class];
    }
}
