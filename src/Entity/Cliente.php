<?php

namespace App\Entity;

use App\Repository\ClienteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClienteRepository::class)]
class Cliente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'clientes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Pessoa $tipo = null;

    #[ORM\ManyToMany(targetEntity: Servico::class, mappedBy: 'relation')]
    private Collection $servicos;

    public function __construct()
    {
        $this->servicos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipo(): ?Pessoa
    {
        return $this->tipo;
    }

    public function setTipo(?Pessoa $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * @return Collection<int, Servico>
     */
    public function getServicos(): Collection
    {
        return $this->servicos;
    }

    public function addServico(Servico $servico): self
    {
        if (!$this->servicos->contains($servico)) {
            $this->servicos->add($servico);
            $servico->addRelation($this);
        }

        return $this;
    }

    public function removeServico(Servico $servico): self
    {
        if ($this->servicos->removeElement($servico)) {
            $servico->removeRelation($this);
        }

        return $this;
    }
}
