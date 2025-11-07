<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
class Ecurie
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column(type:"integer")]
    private int $id;

    #[ORM\Column(type:"string", length:255)]
    private string $name;

    #[ORM\Column(type:"string", length:255)]
    private string $car;

    #[ORM\OneToMany(mappedBy:"ecurie", targetEntity:Pilotes::class)]
    private Collection $pilotes;

    public function __construct() { $this->pilotes = new ArrayCollection(); }
    // getters & setters
}
