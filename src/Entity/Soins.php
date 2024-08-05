<?php

namespace App\Entity;

use App\Repository\SoinsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SoinsRepository::class)]
class Soins
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

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Infirmiere $infirmiere = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Hospitalisation $hospitalisation = null;

    #[ORM\Column(length: 255)]
    private ?string $Frequence_Cardiaque = null;

    #[ORM\Column(length: 255)]
    private ?string $Pression_artérielle = null;

    #[ORM\Column(length: 255)]
    private ?string $Température = null;

    #[ORM\Column(length: 255)]
    private ?string $pression_respiratoire = null;

    #[ORM\Column(length: 255)]
    private ?string $Diurèse = null;

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


    public function getInfirmiere(): ?Infirmiere
    {
        return $this->infirmiere;
    }

    public function setInfirmiere(?Infirmiere $infirmiere): static
    {
        $this->infirmiere = $infirmiere;

        return $this;
    }

    public function getHospitalisation(): ?Hospitalisation
    {
        return $this->hospitalisation;
    }

    public function setHospitalisation(?Hospitalisation $hospitalisation): static
    {
        $this->hospitalisation = $hospitalisation;

        return $this;
    }

    public function getFrequenceCardiaque(): ?string
    {
        return $this->Frequence_Cardiaque;
    }

    public function setFrequenceCardiaque(string $Frequence_Cardiaque): static
    {
        $this->Frequence_Cardiaque = $Frequence_Cardiaque;

        return $this;
    }

    public function getPressionArtérielle(): ?string
    {
        return $this->Pression_artérielle;
    }

    public function setPressionArtérielle(string $Pression_artérielle): static
    {
        $this->Pression_artérielle = $Pression_artérielle;

        return $this;
    }

    public function getTempérature(): ?string
    {
        return $this->Température;
    }

    public function setTempérature(string $Température): static
    {
        $this->Température = $Température;

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

    public function getDiurèse(): ?string
    {
        return $this->Diurèse;
    }

    public function setDiurèse(string $Diurèse): static
    {
        $this->Diurèse = $Diurèse;

        return $this;
    }

    public function __toString()
    {
      return " ".$this->getInfirmiere()." ".$this->getHospitalisation();
    }
}
