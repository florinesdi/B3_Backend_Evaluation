<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Pilotes
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column(type:"integer")]
    private int $id;

    #[ORM\Column(type:"string", length:255)]
    private string $firstName;

    #[ORM\Column(type:"string", length:255)]
    private string $lastName;

    #[ORM\Column(type:"integer")]
    private int $points = 12;

    #[ORM\Column(type:"string", length:50)]
    private string $statut;

    #[ORM\Column(type:"datetime")]
    private \DateTimeInterface $startDate;

    #[ORM\ManyToOne(targetEntity:Ecurie::class, inversedBy:"pilotes")]
    private ?Ecurie $ecurie = null;

    // getters & setters
}
