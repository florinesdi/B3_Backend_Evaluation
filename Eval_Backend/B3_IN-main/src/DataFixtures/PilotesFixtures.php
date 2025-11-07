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
            // Ferrari
            ['FirstName'=>'Charles','LastName'=>'Leclerc','Ecurie'=>'Ferrari','Points'=>12,'Statut'=>'titulaire','StartDate'=>'2018-03-18'],
            ['FirstName'=>'Carlos','LastName'=>'Sainz','Ecurie'=>'Ferrari','Points'=>12,'Statut'=>'titulaire','StartDate'=>'2015-03-15'],
            ['FirstName'=>'Mick','LastName'=>'Schumacher','Ecurie'=>'Ferrari','Points'=>12,'Statut'=>'réserviste','StartDate'=>'2021-03-18'],
            
            // Mercedes
            ['FirstName'=>'Lewis','LastName'=>'Hamilton','Ecurie'=>'Mercedes','Points'=>12,'Statut'=>'titulaire','StartDate'=>'2007-03-18'],
            ['FirstName'=>'George','LastName'=>'Russell','Ecurie'=>'Mercedes','Points'=>12,'Statut'=>'titulaire','StartDate'=>'2019-03-17'],
            ['FirstName'=>'Nyck','LastName'=>'de Vries','Ecurie'=>'Mercedes','Points'=>12,'Statut'=>'réserviste','StartDate'=>'2023-03-18'],
            
            // Red Bull
            ['FirstName'=>'Max','LastName'=>'Verstappen','Ecurie'=>'Red Bull','Points'=>12,'Statut'=>'titulaire','StartDate'=>'2015-03-18'],
            ['FirstName'=>'Sergio','LastName'=>'Perez','Ecurie'=>'Red Bull','Points'=>12,'Statut'=>'titulaire','StartDate'=>'2011-03-18'],
            ['FirstName'=>'Liam','LastName'=>'Lawson','Ecurie'=>'Red Bull','Points'=>12,'Statut'=>'réserviste','StartDate'=>'2023-03-18'],
        ];

        foreach ($pilotesData as $data) {
            $pilote = new Pilotes();
            $pilote->setFirstName($data['FirstName']);
            $pilote->setLastName($data['LastName']);
            $pilote->setPoints($data['Points']);
            $pilote->setStatut($data['Statut']);
            $pilote->setStartDate(new \DateTime($data['StartDate']));

            $referenceName = 'ecurie_' . str_replace(' ', '_', $data['Ecurie']);
            $pilote->setEcurie($this->getReference($referenceName));

            $manager->persist($pilote);

            // Référence pour les infractions
            $this->addReference('pilote_' . $data['FirstName'] . '_' . $data['LastName'], $pilote);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [EcurieFixtures::class];
    }
}
