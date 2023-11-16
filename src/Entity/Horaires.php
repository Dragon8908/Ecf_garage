<?php

namespace App\Entity;

use App\Repository\HorairesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HorairesRepository::class)]
class Horaires
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $jour = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ouvertureMatin = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fermetureMatin = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ouvertureAprem = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fermetureAprem = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJour(): ?string
    {
        return $this->jour;
    }

    public function setJour(string $jour): static
    {
        $this->jour = $jour;

        return $this;
    }

    public function getOuvertureMatin(): ?string
    {
        return $this->ouvertureMatin;
    }

    public function setOuvertureMatin(?string $ouvertureMatin): static
    {
        $this->ouvertureMatin = $ouvertureMatin;

        return $this;
    }

    public function getFermetureMatin(): ?string
    {
        return $this->fermetureMatin;
    }

    public function setFermetureMatin(?string $fermetureMatin): static
    {
        $this->fermetureMatin = $fermetureMatin;

        return $this;
    }

    public function getOuvertureAprem(): ?string
    {
        return $this->ouvertureAprem;
    }

    public function setOuvertureAprem(?string $ouvertureAprem): static
    {
        $this->ouvertureAprem = $ouvertureAprem;

        return $this;
    }

    public function getFermetureAprem(): ?string
    {
        return $this->fermetureAprem;
    }

    public function setFermetureAprem(?string $fermetureAprem): static
    {
        $this->fermetureAprem = $fermetureAprem;

        return $this;
    }
}
