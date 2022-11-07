<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221024101136 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employer ADD idprojet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE employer ADD CONSTRAINT FK_DE4CF0667EDA2B87 FOREIGN KEY (idprojet_id) REFERENCES projet (id)');
        $this->addSql('CREATE INDEX IDX_DE4CF0667EDA2B87 ON employer (idprojet_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employer DROP FOREIGN KEY FK_DE4CF0667EDA2B87');
        $this->addSql('DROP INDEX IDX_DE4CF0667EDA2B87 ON employer');
        $this->addSql('ALTER TABLE employer DROP idprojet_id');
    }
}
