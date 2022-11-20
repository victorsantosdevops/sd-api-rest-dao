<?php

namespace App\Entity;

use App\Repository\PagCartaoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PagCartaoRepository::class)]
class PagCartao
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $parcelas = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Pagamento $relation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParcelas(): ?int
    {
        return $this->parcelas;
    }

    public function setParcelas(int $parcelas): self
    {
        $this->parcelas = $parcelas;

        return $this;
    }

    public function getRelation(): ?Pagamento
    {
        return $this->relation;
    }

    public function setRelation(?Pagamento $relation): self
    {
        $this->relation = $relation;

        return $this;
    }
}
