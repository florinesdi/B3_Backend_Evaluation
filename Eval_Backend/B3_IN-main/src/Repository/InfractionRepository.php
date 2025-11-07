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
            ['type'=>'penalite','points'=>3,'montant'=>null,'description'=>'Dépassement dangereux','pilote'=>'Lewis_Hamilton','ecurie'=>null,'date'=>'2025-06-01'],
            ['type'=>'amende','points'=>null,'montant'=>5000,'description'=>'Violation technique','pilote'=>null,'ecurie'=>'Ferrari','date'=>'2025-06-02'],
            ['type'=>'penalite','points'=>2,'montant'=>null,'description'=>'Collision en course','pilote'=>'Max_Verstappen','ecurie'=>null,'date'=>'2025-06-03'],
        ];

        foreach ($infractionsData as $data) {
            $infraction = new Infraction();
            $infraction->setType($data['type']);
            $infraction->setPoints($data['points']);
            $infraction->setMontant($data['montant']);
            $infraction->setDescription($data['description']);
            $infraction->setDate(new \DateTime($data['date']));

            if($data['pilote']) {
                $infraction->setPilote($this->getReference('pilote_' . $data['pilote']));
            }

            if($data['ecurie']) {
                $infraction->setEcurie($this->getReference('ecurie_' . str_replace(' ', '_', $data['ecurie'])));
            }

            $manager->persist($infraction);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [PilotesFixtures::class];
    }
}