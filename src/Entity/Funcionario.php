<?php

namespace App\Entity;

use App\Repository\FuncionarioRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FuncionarioRepository::class)]
class Funcionario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $funcao = null;

    #[ORM\OneToOne(inversedBy: 'funcionario', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Pessoa $no = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFuncao(): ?string
    {
        return $this->funcao;
    }

    public function setFuncao(string $funcao): self
    {
        $this->funcao = $funcao;

        return $this;
    }

    public function getNo(): ?Pessoa
    {
        return $this->no;
    }

    public function setNo(Pessoa $no): self
    {
        $this->no = $no;

        return $this;
    }
}
