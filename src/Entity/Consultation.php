<?php

namespace App\Entity;

use App\Repository\ConsultationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConsultationRepository::class)]
class Consultation
{

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $user_create;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $user_update;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $user_delete;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $date_create;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $date_update;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $date_delete;



    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;



    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    private ?string $motif = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $diagnostique = null;

   


    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Medecin $medecin = null;


    #[ORM\Column(length: 255)]
    private ?string $poids = null;

    #[ORM\Column(length: 255)]
    private ?string $taille = null;

    #[ORM\Column(length: 255)]
    private ?string $temperature = null;

    #[ORM\Column(length: 255)]
    private ?string $frequence_cardiaque = null;

    #[ORM\Column(length: 255)]
    private ?string $tension = null;

    #[ORM\Column(length: 255)]
    private ?string $pression_respiratoire = null;

    #[ORM\Column(length: 255)]
    private ?string $diurese = null;

    #[ORM\ManyToOne]
    private ?Rdv $rdv = null;

    public function getUserCreate(): ?string
    {
        return $this->user_create;
    }

    public function setUserCreate(?string $user_create): static
    {
        $this->user_create = $user_create;

        return $this;
    }

    public function getUserUpdate(): ?string
    {
        return $this->user_update;
    }

    public function setUserUpdate(?string $user_update): static
    {
        $this->user_update = $user_update;

        return $this;
    }

    public function getUserDelete(): ?string
    {
        return $this->user_delete;
    }

    public function setUserDelete(?string $user_delete): static
    {
        $this->user_delete = $user_delete;

        return $this;
    }

    public function getDateCreate(): ?\DateTimeInterface
    {
        return $this->date_create;
    }

    public function setDateCreate(?\DateTimeInterface $date_create): static
    {
        $this->date_create = $date_create;

        return $this;
    }

    public function getDateUpdate(): ?\DateTimeInterface
    {
        return $this->date_update;
    }

    public function setDateUpdate(?\DateTimeInterface $date_update): static
    {
        $this->date_update = $date_update;

        return $this;
    }

    public function getDateDelete(): ?\DateTimeInterface
    {
        return $this->date_delete;
    }

    public function setDateDelete(?\DateTimeInterface $date_delete): static
    {
        $this->date_delete = $date_delete;

        return $this;
    }

    

    public function getId(): ?int
    {
        return $this->id;
    }

 

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getMotif(): ?string
    {
        return $this->motif;
    }

    public function setMotif(string $motif): static
    {
        $this->motif = $motif;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getdiagnostique(): ?string
    {
        return $this->diagnostique;
    }

    public function setdiagnostique(string $diagnostique): static
    {
        $this->diagnostique = $diagnostique;

        return $this;
    }


 
    public function getMedecin(): ?Medecin
    {
        return $this->medecin;
    }

    public function setMedecin(?Medecin $medecin): static
    {
        $this->medecin = $medecin;

        return $this;
    }


    public function getPoids(): ?string
    {
        return $this->poids;
    }

    public function setPoids(string $poids): static
    {
        $this->poids = $poids;

        return $this;
    }

    public function gettaille(): ?string
    {
        return $this->taille;
    }

    public function settaille(string $taille): static
    {
        $this->taille = $taille;

        return $this;
    }

    public function gettemperature(): ?string
    {
        return $this->temperature;
    }

    public function settemperature(string $temperature): static
    {
        $this->temperature = $temperature;

        return $this;
    }

    public function getfrequenceCardiaque(): ?string
    {
        return $this->frequence_cardiaque;
    }

    public function setfrequenceCardiaque(string $frequence_cardiaque): static
    {
        $this->frequence_cardiaque = $frequence_cardiaque;

        return $this;
    }

    public function getTension(): ?string
    {
        return $this->tension;
    }

    public function setTension(string $tension): static
    {
        $this->tension = $tension;

        return $this;
    }

    public function getpressionRespiratoire(): ?string
    {
        return $this->pression_respiratoire;
    }

    public function setpressionRespiratoire(string $pression_respiratoire): static
    {
        $this->pression_respiratoire = $pression_respiratoire;

        return $this;
    }

    public function getdiurese(): ?string
    {
        return $this->diurese;
    }

    public function setdiurese(string $diurese): static
    {
        $this->diurese = $diurese;

        return $this;
    }

    public function __toString()
    {
      return " ".$this->getRdv();
    }

    public function getRdv(): ?Rdv
    {
        return $this->rdv;
    }

    public function setRdv(?Rdv $rdv): static
    {
        $this->rdv = $rdv;

        return $this;
    }

   
}
