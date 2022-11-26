<?php

namespace App\Entity;

use App\Repository\PessoaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PessoaRepository::class)]
class Pessoa
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nome = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $codNac = null;

    #[ORM\ManyToOne(inversedBy: 'relation')]
    private ?Endereco $endereco = null;

    #[ORM\ManyToOne(inversedBy: 'relation')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Telefone $telefone = null;

    #[ORM\OneToOne(mappedBy: 'no', cascade: ['persist', 'remove'])]
    private ?Funcionario $funcionario = null;

    #[ORM\OneToMany(mappedBy: 'tipo', targetEntity: Cliente::class, orphanRemoval: true)]
    private Collection $clientes;

    public function __construct()
    {
        $this->clientes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCodNac(): ?string
    {
        return $this->codNac;
    }

    public function setCodNac(string $codNac): self
    {
        $this->codNac = $codNac;

        return $this;
    }

    public function getEndereco(): ?Endereco
    {
        return $this->endereco;
    }

    public function setEndereco(?Endereco $endereco): self
    {
        $this->endereco = $endereco;

        return $this;
    }

    public function getTelefone(): ?Telefone
    {
        return $this->telefone;
    }

    public function setTelefone(?Telefone $telefone): self
    {
        $this->telefone = $telefone;

        return $this;
    }

    public function getFuncionario(): ?Funcionario
    {
        return $this->funcionario;
    }

    public function setFuncionario(Funcionario $funcionario): self
    {
        // set the owning side of the relation if necessary
        if ($funcionario->getNo() !== $this) {
            $funcionario->setNo($this);
        }

        $this->funcionario = $funcionario;

        return $this;
    }

    /**
     * @return Collection<int, Cliente>
     */
    public function getClientes(): Collection
    {
        return $this->clientes;
    }

    public function addCliente(Cliente $cliente): self
    {
        if (!$this->clientes->contains($cliente)) {
            $this->clientes->add($cliente);
            $cliente->setTipo($this);
        }

        return $this;
    }

    public function removeCliente(Cliente $cliente): self
    {
        if ($this->clientes->removeElement($cliente)) {
            // set the owning side to null (unless already changed)
            if ($cliente->getTipo() === $this) {
                $cliente->setTipo(null);
            }
        }

        return $this;
    }
}
