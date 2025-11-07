<?php

namespace App\Controller;

use App\Entity\Pilote;
use App\Entity\Ecurie;
use App\Entity\Infraction;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_')]
class ApiController extends AbstractController
{
    #[Route('/pilotes', name: 'pilotes', methods: ['GET'])]
    public function pilotes(EntityManagerInterface $em): JsonResponse
    {
        $pilotes = $em->getRepository(Pilote::class)->findAll();
        $data = [];

        foreach ($pilotes as $pilote) {
            $data[] = [
                'id' => $pilote->getId(),
                'prenom' => $pilote->getPrenom(),
                'nom' => $pilote->getNom(),
                'ecurie' => $pilote->getEcurie() ? $pilote->getEcurie()->getNom() : null,
                'points' => $pilote->getPointsLicence(),
                'statut' => $pilote->getStatut(),
                'debutF1' => $pilote->getDateDebutF1() ? $pilote->getDateDebutF1()->format('Y-m-d') : null,
            ];
        }

        return $this->json([
            'success' => true,
            'count' => count($data),
            'data' => $data
        ]);
    }

    #[Route('/ecuries', name: 'ecuries', methods: ['GET'])]
    public function ecuries(EntityManagerInterface $em): JsonResponse
    {
        $ecuries = $em->getRepository(Ecurie::class)->findAll();
        $data = [];

        foreach ($ecuries as $ecurie) {
            $data[] = [
                'id' => $ecurie->getId(),
                'nom' => $ecurie->getNom(),
            ];
        }

        return $this->json([
            'success' => true,
            'count' => count($data),
            'data' => $data
        ]);
    }

    #[Route('/infractions', name: 'infractions', methods: ['GET'])]
    public function infractions(EntityManagerInterface $em): JsonResponse
    {
        $infractions = $em->getRepository(Infraction::class)->findAll();
        $data = [];

        foreach ($infractions as $infraction) {
            $data[] = [
                'id' => $infraction->getId(),
                'description' => $infraction->getDescription(),
                'points' => $infraction->getPoints(),
                'pilote' => $infraction->getPilote() 
                    ? $infraction->getPilote()->getPrenom() . ' ' . $infraction->getPilote()->getNom() 
                    : null,
            ];
        }

        return $this->json([
            'success' => true,
            'count' => count($data),
            'data' => $data
        ]);
    }
}
