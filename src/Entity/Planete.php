<?php

namespace App\Entity;

use App\Repository\PlaneteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints as AppConstraint;

/**
 * @ORM\Entity(repositoryClass=PlaneteRepository::class)
 */
class Planete
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull(message="Veuillez entrez le nom de planète")
     * @AppConstraint\OnlyLetter(message="Les chiffres ne sont pas autorisés")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotNull(message="Veuillez selectionner un type de terrain")
     */
    private $terrain;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotNull(message="Veuillez entrez la distance de la planète")
     * @Assert\GreaterThan(
     *     value = 300,
     *     message= "{{ value }} doit etre supérieur à 300km"
     * )
     */
    private $nbKmTerre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotNull(message="Veuillez entrez l'allegiance de la planète")
     */
    private $allegiance;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotNull(message="Veuillez entrez la description de la planète")

     */
    private $description;

    /**
     * @ORM\Column(type="date", name="date_decouverte")
     * @Assert\NotNull(message="Veuillez entrez la date de découverte de la planète")
     */
    private $deteDecouverte;

    /**
     * @ORM\OneToMany(targetEntity=Resident::class, mappedBy="planete", fetch="EAGER", cascade={"remove"})
     */
    private $rensidents;

    public function __construct()
    {
        $this->rensidents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getTerrain(): ?string
    {
        return $this->terrain;
    }

    public function setTerrain(?string $terrain): self
    {
        $this->terrain = $terrain;

        return $this;
    }

    public function getNbKmTerre(): ?int
    {
        return $this->nbKmTerre;
    }

    public function setNbKmTerre(int $nbKmTerre): self
    {
        $this->nbKmTerre = $nbKmTerre;

        return $this;
    }

    public function getAllegiance(): ?string
    {
        return $this->allegiance;
    }

    public function setAllegiance(?string $allegiance): self
    {
        $this->allegiance = $allegiance;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDeteDecouverte(): ?\DateTimeInterface
    {
        return $this->deteDecouverte;
    }

    public function setDeteDecouverte(\DateTimeInterface $deteDecouverte): self
    {
        $this->deteDecouverte = $deteDecouverte;

        return $this;
    }

    /**
     * @return Collection|Resident[]
     */
    public function getRensidents(): Collection
    {
        return $this->rensidents;
    }

    public function addRensident(Resident $rensident): self
    {
        if (!$this->rensidents->contains($rensident)) {
            $this->rensidents[] = $rensident;
            $rensident->setPlanete($this);
        }

        return $this;
    }

    public function removeRensident(Resident $rensident): self
    {
        if ($this->rensidents->contains($rensident)) {
            $this->rensidents->removeElement($rensident);
            // set the owning side to null (unless already changed)
            if ($rensident->getPlanete() === $this) {
                $rensident->setPlanete(null);
            }
        }

        return $this;
    }
}
