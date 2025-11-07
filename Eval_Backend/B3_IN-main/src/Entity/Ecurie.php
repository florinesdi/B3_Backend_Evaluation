<?php

namespace App\Entity;

use App\Repository\EcurieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EcurieRepository::class)]
class Ecurie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $Name = null;

    #[ORM\Column(length: 50)]
    private ?string $Car = null;

    /**
     * @var Collection<int, Pilotes>
     */
    #[ORM\OneToMany(targetEntity: Pilotes::class, mappedBy: 'ecurie')]
    private Collection $pilotes;

    public function __construct()
    {
        $this->pilotes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): static
    {
        $this->Name = $Name;

        return $this;
    }

    public function getCar(): ?string
    {
        return $this->Car;
    }

    public function setCar(string $Car): static
    {
        $this->Car = $Car;

        return $this;
    }

    /**
     * @return Collection<int, Pilotes>
     */
    public function getPilotes(): Collection
    {
        return $this->pilotes;
    }

    public function addPilote(Pilotes $pilote): static
    {
        if (!$this->pilotes->contains($pilote)) {
            $this->pilotes->add($pilote);
            $pilote->setEcurie($this);
        }

        return $this;
    }

    public function removePilote(Pilotes $pilote): static
    {
        if ($this->pilotes->removeElement($pilote)) {
            // set the owning side to null (unless already changed)
            if ($pilote->getEcurie() === $this) {
                $pilote->setEcurie(null);
            }
        }

        return $this;
    }
}
