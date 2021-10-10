<?php

namespace App\Entity;

use App\Repository\WalletRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WalletRepository::class)
 */
class Wallet
{
    const CURRENCIES = ['EUR','USD','CHF','JPY','CZK'];
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="integer")
     */
    private $plnAvailable;

    /**
     * @ORM\Column(type="json")
     */
    private $currencies = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPlnAvailable(): ?int
    {
        return $this->plnAvailable;
    }

    public function setPlnAvailable(int $plnAvailable): self
    {
        $this->plnAvailable = $plnAvailable;

        return $this;
    }

    public function getCurrencies(): ?array
    {
        return $this->currencies;
    }

    public function setCurrencies(array $currencies): self
    {
        $this->currencies = $currencies;

        return $this;
    }

}
