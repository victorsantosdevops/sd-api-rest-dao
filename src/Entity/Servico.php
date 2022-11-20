<?php

namespace App\Entity;

use App\Repository\ServicoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServicoRepository::class)]
class Servico
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dataEntrada = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dataSaida = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $descricao = null;

    #[ORM\ManyToMany(targetEntity: Cliente::class, inversedBy: 'servicos')]
    private Collection $relation;

    #[ORM\ManyToOne(inversedBy: 'relation')]
    private ?Produto $produto = null;

    #[ORM\OneToOne(mappedBy: 'relation', cascade: ['persist', 'remove'])]
    private ?Pet $pet = null;

    #[ORM\ManyToMany(targetEntity: Pagamento::class, mappedBy: 'relation')]
    private Collection $pagamentos;

    public function __construct()
    {
        $this->relation = new ArrayCollection();
        $this->pagamentos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDataEntrada(): ?\DateTimeInterface
    {
        return $this->dataEntrada;
    }

    public function setDataEntrada(\DateTimeInterface $dataEntrada): self
    {
        $this->dataEntrada = $dataEntrada;

        return $this;
    }

    public function getDataSaida(): ?\DateTimeInterface
    {
        return $this->dataSaida;
    }

    public function setDataSaida(?\DateTimeInterface $dataSaida): self
    {
        $this->dataSaida = $dataSaida;

        return $this;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(?string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * @return Collection<int, Cliente>
     */
    public function getRelation(): Collection
    {
        return $this->relation;
    }

    public function addRelation(Cliente $relation): self
    {
        if (!$this->relation->contains($relation)) {
            $this->relation->add($relation);
        }

        return $this;
    }

    public function removeRelation(Cliente $relation): self
    {
        $this->relation->removeElement($relation);

        return $this;
    }

    public function getProduto(): ?Produto
    {
        return $this->produto;
    }

    public function setProduto(?Produto $produto): self
    {
        $this->produto = $produto;

        return $this;
    }

    public function getPet(): ?Pet
    {
        return $this->pet;
    }

    public function setPet(Pet $pet): self
    {
        // set the owning side of the relation if necessary
        if ($pet->getRelation() !== $this) {
            $pet->setRelation($this);
        }

        $this->pet = $pet;

        return $this;
    }

    /**
     * @return Collection<int, Pagamento>
     */
    public function getPagamentos(): Collection
    {
        return $this->pagamentos;
    }

    public function addPagamento(Pagamento $pagamento): self
    {
        if (!$this->pagamentos->contains($pagamento)) {
            $this->pagamentos->add($pagamento);
            $pagamento->addRelation($this);
        }

        return $this;
    }

    public function removePagamento(Pagamento $pagamento): self
    {
        if ($this->pagamentos->removeElement($pagamento)) {
            $pagamento->removeRelation($this);
        }

        return $this;
    }
}
