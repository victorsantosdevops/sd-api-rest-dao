<?php

namespace App\Entity;

use App\Repository\TelefoneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TelefoneRepository::class)]
class Telefone
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $numero = null;

    #[ORM\OneToMany(mappedBy: 'telefone', targetEntity: Pessoa::class, orphanRemoval: true)]
    private Collection $relation;

    public function __construct()
    {
        $this->relation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * @return Collection<int, Pessoa>
     */
    public function getRelation(): Collection
    {
        return $this->relation;
    }

    public function addRelation(Pessoa $relation): self
    {
        if (!$this->relation->contains($relation)) {
            $this->relation->add($relation);
            $relation->setTelefone($this);
        }

        return $this;
    }

    public function removeRelation(Pessoa $relation): self
    {
        if ($this->relation->removeElement($relation)) {
            // set the owning side to null (unless already changed)
            if ($relation->getTelefone() === $this) {
                $relation->setTelefone(null);
            }
        }

        return $this;
    }
}
