<?php

namespace App\Entity;

use App\Repository\ReservationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationsRepository::class)
 */
class Reservations
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lieu;

    /**
     * @ORM\OneToMany(targetEntity=Coachs::class, mappedBy="reservations")
     */
    private $coach_id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $coach;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="nom")
     */
    private $User_name;

    public function __construct()
    {
        $this->coach_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(?string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * @return Collection|Coachs[]
     */
    public function getCoachId(): Collection
    {
        return $this->coach_id;
    }

    public function addCoachId(Coachs $coachId): self
    {
        if (!$this->coach_id->contains($coachId)) {
            $this->coach_id[] = $coachId;
            $coachId->setReservations($this);
        }

        return $this;
    }

    public function removeCoachId(Coachs $coachId): self
    {
        if ($this->coach_id->removeElement($coachId)) {
            // set the owning side to null (unless already changed)
            if ($coachId->getReservations() === $this) {
                $coachId->setReservations(null);
            }
        }

        return $this;
    }

    public function getCoach(): ?string
    {
        return $this->coach;
    }

    public function setCoach(?string $coach): self
    {
        $this->coach = $coach;

        return $this;
    }

    public function getUserName(): ?User
    {
        return $this->User_name;
    }

    public function setUserName(?User $User_name): self
    {
        $this->User_name = $User_name;

        return $this;
    }
}
