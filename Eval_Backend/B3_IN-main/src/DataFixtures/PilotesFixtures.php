<?php

namespace App\DataFixtures;

use App\Entity\Pilotes;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PilotesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $pilotesData = [
            ['FirstName' => 'Charles', 'LastName' => 'Leclerc', 'Ecurie' => 'Scuderia Ferrari', 'Points' => 12, 'Statut' => 'titulaire', 'StartDate' => '2018-03-18'],
            ['FirstName' => 'Carlos', 'LastName' => 'Sainz', 'Ecurie' => 'Scuderia Ferrari', 'Points' => 12, 'Statut' => 'titulaire', 'StartDate' => '2015-03-15'],
            ['FirstName' => 'Lewis', 'LastName' => 'Hamilton', 'Ecurie' => 'Mercedes-AMG Petronas', 'Points' => 12, 'Statut' => 'titulaire', 'StartDate' => '2007-03-18'],
            ['FirstName' => 'George', 'LastName' => 'Russell', 'Ecurie' => 'Mercedes-AMG Petronas', 'Points' => 12, 'Statut' => 'titulaire', 'StartDate' => '2019-03-17'],
        ];

        foreach ($pilotesData as $data) {
            $pilote = new Pilotes();
            $pilote->setFirstName($data['FirstName']);
            $pilote->setLastName($data['LastName']);
            $pilote->setPoints($data['Points']);
            $pilote->setStatut($data['Statut']);
            $pilote->setStartDate(new \DateTime($data['StartDate']));
            $pilote->setEcurie($this->getReference('ecurie_' . $data['Ecurie']));

            $manager->persist($pilote);

            $this->addReference('pilote_' . $data['FirstName'] . '_' . $data['LastName'], $pilote);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [EcurieFixtures::class];
    }
}
