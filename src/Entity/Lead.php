<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\LeadRepository;

#[ORM\Entity(repositoryClass: LeadRepository::class)]
#[ORM\Table(name: 'leads')]
class Lead
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id', type: 'integer')]
    private int $id;

    #[ORM\Column(name: 'country', type: 'string', length: 64)]
    private string $country;

    #[ORM\Column(name: 'administrative_area', type: 'string', length: 255)]
    private string $county;

    #[ORM\Column(name: 'niche', type: 'string', length: 255)]
    private string $niche;

    #[ORM\Column(name: 'business_name', type: 'string', length: 255, nullable: true)]
    private string $businessName;

    #[ORM\Column(name: 'business_address', type: 'string', length: 255)]
    private string $businessAddress;

    #[ORM\Column(name: 'phone', type: 'string', unique: true, nullable: true)]
    private string $phone;

    #[ORM\Column(name: 'emails', type: 'string')]
    private ?string $emails;

    #[ORM\Column(name: 'website', type: 'string')]
    private ?string $website;

    #[ORM\Column(name: 'rating', type: 'string')]
    private string $businessRating;

    #[ORM\Column(name: 'contact_name', type: 'string', nullable: true)]
    private ?string $contactName;

    #[ORM\Column(name: 'website_summary', type: 'string', nullable: true)]
    private ?string $websiteSummary;

    public function __construct(
        string $country,
        string $county,
        string $niche,
        string $businessName,
        string $businessAddress,
        string $phone,
        string $businessRating,
        ?string $emails,
        ?string $website,
        ?string $contactName,
        ?string $websiteSummary,
    ) {
        $this->country        = $country;
        $this->county         = $county;
        $this->niche           = $niche;
        $this->businessName    = $businessName;
        $this->businessAddress = $businessAddress;
        $this->phone           = $phone;
        $this->emails          = $emails;
        $this->website         = $website;
        $this->businessRating  = $businessRating;
        $this->contactName     = $contactName;
        $this->websiteSummary  = $websiteSummary;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getCounty(): string
    {
        return $this->county;
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

    public function getEmails(): ?string
    {
        return $this->emails;
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

    public function getBusinessAddress(): string
    {
        return $this->businessAddress;
    }

    public function setEmails(string $emails): void
    {
        $this->emails = $emails;
    }

    public function setWebsite(string $website): void
    {
        $this->website = $website;
    }

    public function setContactName(string $contactName): void
    {
        $this->contactName = $contactName;
    }

    public function setWebsiteSummary(string $websiteSummary): void
    {
        $this->websiteSummary = $websiteSummary;
    }
}
