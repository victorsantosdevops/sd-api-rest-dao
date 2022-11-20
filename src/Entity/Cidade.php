<?php

namespace App\Entity;

use App\Repository\CidadeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CidadeRepository::class)]
class Cidade
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'cidade', targetEntity: Endereco::class)]
    private Collection $nome;

    #[ORM\OneToMany(mappedBy: 'relation', targetEntity: Estado::class)]
    private Collection $estados;

    public function __construct()
    {
        $this->nome = new ArrayCollection();
        $this->estados = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Endereco>
     */
    public function getNome(): Collection
    {
        return $this->nome;
    }

    public function addNome(Endereco $nome): self
    {
        if (!$this->nome->contains($nome)) {
            $this->nome->add($nome);
            $nome->setCidade($this);
        }

        return $this;
    }

    public function removeNome(Endereco $nome): self
    {
        if ($this->nome->removeElement($nome)) {
            // set the owning side to null (unless already changed)
            if ($nome->getCidade() === $this) {
                $nome->setCidade(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Estado>
     */
    public function getEstados(): Collection
    {
        return $this->estados;
    }

    public function addEstado(Estado $estado): self
    {
        if (!$this->estados->contains($estado)) {
            $this->estados->add($estado);
            $estado->setRelation($this);
        }

        return $this;
    }

    public function removeEstado(Estado $estado): self
    {
        if ($this->estados->removeElement($estado)) {
            // set the owning side to null (unless already changed)
            if ($estado->getRelation() === $this) {
                $estado->setRelation(null);
            }
        }

        return $this;
    }
}
