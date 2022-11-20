<?php

namespace App\Entity;

use App\Repository\PagDinheiroRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PagDinheiroRepository::class)]
class PagDinheiro
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dataVencimento = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dataPagamento = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Pagamento $relation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDataVencimento(): ?\DateTimeInterface
    {
        return $this->dataVencimento;
    }

    public function setDataVencimento(\DateTimeInterface $dataVencimento): self
    {
        $this->dataVencimento = $dataVencimento;

        return $this;
    }

    public function getDataPagamento(): ?\DateTimeInterface
    {
        return $this->dataPagamento;
    }

    public function setDataPagamento(\DateTimeInterface $dataPagamento): self
    {
        $this->dataPagamento = $dataPagamento;

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
