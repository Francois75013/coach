<?php

namespace App\Entity;

use App\Repository\ResaPrecedRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ResaPrecedRepository::class)
 */
class ResaPreced
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Reservation::class, inversedBy="resaPreced", cascade={"persist", "remove"})
     */
    private $resa_preced;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getResaPreced(): ?Reservation
    {
        return $this->resa_preced;
    }

    public function setResaPreced(?Reservation $resa_preced): self
    {
        $this->resa_preced = $resa_preced;

        return $this;
    }
}
