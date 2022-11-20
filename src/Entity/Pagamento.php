<?php

namespace App\Entity;

use App\Repository\PagamentoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PagamentoRepository::class)]
class Pagamento
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $situacao = null;

    #[ORM\ManyToMany(targetEntity: Servico::class, inversedBy: 'pagamentos')]
    private Collection $relation;

    public function __construct()
    {
        $this->relation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSituacao(): ?string
    {
        return $this->situacao;
    }

    public function setSituacao(string $situacao): self
    {
        $this->situacao = $situacao;

        return $this;
    }

    /**
     * @return Collection<int, Servico>
     */
    public function getRelation(): Collection
    {
        return $this->relation;
    }

    public function addRelation(Servico $relation): self
    {
        if (!$this->relation->contains($relation)) {
            $this->relation->add($relation);
        }

        return $this;
    }

    public function removeRelation(Servico $relation): self
    {
        $this->relation->removeElement($relation);

        return $this;
    }
}
