<?php

namespace App\Controller\Api;

use App\Entity\Ecurie;
use App\Entity\Pilote;
use App\Entity\Infraction;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api')]
class ApiController extends AbstractController
{
    // Ici tu ajoutes toutes tes routes GET/POST/PUT pour l'API
}
