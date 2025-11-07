<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Infraction
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column(type:"integer")]
    private int $id;

    #[ORM\Column(type:"string", length:50)]
    private string $type;

    #[ORM\Column(type:"float", nullable:true)]
    private ?float $montant = null;

    #[ORM\Column(type:"integer", nullable:true)]
    private ?int $points = null;

    #[ORM\Column(type:"text")]
    private string $description;

    #[ORM\Column(type:"datetime")]
    private \DateTimeInterface $date;

    #[ORM\ManyToOne(targetEntity:Pilotes::class)]
    private ?Pilotes $pilote = null;

    #[ORM\ManyToOne(targetEntity:Ecurie::class)]
    private ?Ecurie $ecurie = null;

    // getters & setters
}
