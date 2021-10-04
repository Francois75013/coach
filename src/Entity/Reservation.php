<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Coachs::class, inversedBy="reservations")
     */
    private $coach;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reservations")
     */
    private $user;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lieu;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $paiement;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $confirmation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $stripe_token;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $brand_stripe;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $last_stripe;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $last4_stripe;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $id_charge_stripe;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $status_stripe;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_paiement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCoach(): ?Coachs
    {
        return $this->coach;
    }

    public function setCoach(?Coachs $coach): self
    {
        $this->coach = $coach;

        return $this;
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

    public function getPaiement(): ?string
    {
        return $this->paiement;
    }

    public function setPaiement(?string $paiement): self
    {
        $this->paiement = $paiement;

        return $this;
    }

    public function getConfirmation(): ?bool
    {
        return $this->confirmation;
    }

    public function setConfirmation(?bool $confirmation): self
    {
        $this->confirmation = $confirmation;

        return $this;
    }

    public function getStripeToken(): ?string
    {
        return $this->stripe_token;
    }

    public function setStripeToken(?string $stripe_token): self
    {
        $this->stripe_token = $stripe_token;

        return $this;
    }

    public function getBrandStripe(): ?string
    {
        return $this->brand_stripe;
    }

    public function setBrandStripe(?string $brand_stripe): self
    {
        $this->brand_stripe = $brand_stripe;

        return $this;
    }

    public function getLastStripe(): ?string
    {
        return $this->last_stripe;
    }

    public function setLastStripe(?string $last_stripe): self
    {
        $this->last_stripe = $last_stripe;

        return $this;
    }

    public function getLast4Stripe(): ?string
    {
        return $this->last4_stripe;
    }

    public function setLast4Stripe(?string $last4_stripe): self
    {
        $this->last4_stripe = $last4_stripe;

        return $this;
    }

    public function getIdChargeStripe(): ?string
    {
        return $this->id_charge_stripe;
    }

    public function setIdChargeStripe(?string $id_charge_stripe): self
    {
        $this->id_charge_stripe = $id_charge_stripe;

        return $this;
    }

    public function getStatusStripe(): ?string
    {
        return $this->status_stripe;
    }

    public function setStatusStripe(?string $status_stripe): self
    {
        $this->status_stripe = $status_stripe;

        return $this;
    }

    public function getDatePaiement(): ?\DateTimeInterface
    {
        return $this->date_paiement;
    }

    public function setDatePaiement(?\DateTimeInterface $date_paiement): self
    {
        $this->date_paiement = $date_paiement;

        return $this;
    }
}
