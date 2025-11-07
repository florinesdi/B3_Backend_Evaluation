<?php

namespace App\DataFixtures;

use App\Entity\Pilote;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PilotesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $pilotes = [
            ['Charles', 'Leclerc', 'Scuderia Ferrari', 12, 'titulaire', '2018-03-18'],
            ['Carlos', 'Sainz', 'Scuderia Ferrari', 12, 'titulaire', '2015-03-15'],
            ['Lewis', 'Hamilton', 'Mercedes-AMG Petronas', 12, 'titulaire', '2007-03-18'],
            ['George', 'Russell', 'Mercedes-AMG Petronas', 12, 'titulaire', '2019-03-17'],
        ];

        foreach ($pilotes as [$prenom, $nom, $ecurieNom, $points, $statut, $date]) {
            $pilote = new Pilote();
            $pilote->setPrenom($prenom);
            $pilote->setNom($nom);
            $pilote->setPointsLicence($points);
            $pilote->setStatut($statut);
            $pilote->setDateDebutF1(new \DateTime($date));
            $pilote->setEcurie($this->getReference('ecurie' . $ecurieNom));
            $manager->persist($pilote);

            $this->addReference('pilote' . $prenom . $nom, $pilote);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [EcurieFixtures::class];
    }
}
