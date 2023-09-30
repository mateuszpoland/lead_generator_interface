<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230913161017 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE leads (id INT AUTO_INCREMENT NOT NULL, country VARCHAR(64) NOT NULL, administrative_area VARCHAR(255) NOT NULL, niche VARCHAR(255) NOT NULL, business_name VARCHAR(255) DEFAULT NULL, business_address VARCHAR(255) NOT NULL, phone VARCHAR(255) DEFAULT NULL, emails VARCHAR(255) NOT NULL, website VARCHAR(255) NOT NULL, rating VARCHAR(255) NOT NULL, contact_name VARCHAR(255) DEFAULT NULL, website_summary VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_17904552444F97DD (phone), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE leads');
    }
}
