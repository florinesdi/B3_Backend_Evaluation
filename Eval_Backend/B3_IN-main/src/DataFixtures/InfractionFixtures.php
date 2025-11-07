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
        $infractionsData = [
            ['Type' => 'Vitesse', 'Points' => 3, 'Amount' => 100.0, 'Description' => 'Excès de vitesse en course', 'Date' => '2023-08-01', 'RaceName' => 'GP Monaco', 'Pilote' => 'Charles_Leclerc', 'Ecurie' => 'Scuderia Ferrari'],
            ['Type' => 'Collision', 'Points' => 5, 'Amount' => 0, 'Description' => 'Collision avec un autre pilote', 'Date' => '2023-09-10', 'RaceName' => 'GP Italie', 'Pilote' => 'Lewis_Hamilton', 'Ecurie' => 'Mercedes-AMG Petronas'],
        ];

        foreach ($infractionsData as $data) {
            $infraction = new Infraction();
            $infraction->setType($data['Type']);
            $infraction->setPoints($data['Points']);
            $infraction->setAmount($data['Amount']);
            $infraction->setDescription($data['Description']);
            $infraction->setDate(new \DateTime($data['Date']));
            $infraction->setRaceName($data['RaceName']);
            $infraction->setPilote($this->getReference('pilote_' . $data['Pilote']));
            $infraction->setEcurie($this->getReference('ecurie_' . $data['Ecurie']));

            $manager->persist($infraction);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [PilotesFixtures::class];
    }
}
