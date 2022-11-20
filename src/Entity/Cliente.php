<?php

namespace App\Entity;

use App\Repository\ClienteRepository;
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
}
