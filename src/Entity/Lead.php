<?php

declare(strict_types=1);

namespace App\Entity\Lead;

use Doctrine\ORM\Mapping as ORM;
use InvalidArgumentException;

#[ORM\Entity]
#[ORM\Table(name: 'leads')]
class Lead
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id', type: 'integer')]
    private int $id;

    #[ORM\Column(name: 'country', type: 'string', length: 64)]
    private string $country;

    #[ORM\Column(name: 'niche', type: 'string', length: 64)]
    private string $niche;

    #[ORM\Column(name: 'business_name', type: 'string', length: 64, nullable: true)]
    private string $businessName;

    #[ORM\Column(name: 'phone', type: 'string', unique: true)]
    private string $phone;

    #[ORM\Column(name: 'email', type: 'string', unique: true)]
    private ?string $email;

    #[ORM\Column(name: 'website', type: 'string')]
    private ?string $website;

    #[ORM\Column(name: 'rating', type: 'string')]
    private string $businessRating;

    #[ORM\Column(name: 'first_name', type: 'string', nullable: true)]
    private ?string $contactName;

    #[ORM\Column(name: 'last_name', type: 'string', nullable: true)]
    private ?string $websiteSummary;

    public function getId(): int
    {
        return $this->id;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getNiche(): string
    {
        return $this->niche;
    }

    public function getBusinessName(): string
    {
        return $this->businessName;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function getBusinessRating(): string
    {
        return $this->businessRating;
    }

    public function getContactName(): ?string
    {
        return $this->contactName;
    }

    public function getWebsiteSummary(): ?string
    {
        return $this->websiteSummary;
    }
}