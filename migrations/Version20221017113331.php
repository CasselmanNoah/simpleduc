<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221017113331 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE postulant ADD poste_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE postulant ADD CONSTRAINT FK_F7939512A0905086 FOREIGN KEY (poste_id) REFERENCES roles (id)');
        $this->addSql('CREATE INDEX IDX_F7939512A0905086 ON postulant (poste_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE postulant DROP FOREIGN KEY FK_F7939512A0905086');
        $this->addSql('DROP INDEX IDX_F7939512A0905086 ON postulant');
        $this->addSql('ALTER TABLE postulant DROP poste_id');
    }
}
