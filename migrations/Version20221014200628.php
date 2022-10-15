<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221014200628 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fiche_de_paie (id INT AUTO_INCREMENT NOT NULL, id_emp_id INT DEFAULT NULL, salaire_brut VARCHAR(10) NOT NULL, salairenet VARCHAR(10) NOT NULL, matricule VARCHAR(25) NOT NULL, INDEX IDX_B3236E135C5185E5 (id_emp_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE roles (id INT AUTO_INCREMENT NOT NULL, profession VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fiche_de_paie ADD CONSTRAINT FK_B3236E135C5185E5 FOREIGN KEY (id_emp_id) REFERENCES employer (id)');
        $this->addSql('ALTER TABLE employer ADD nom VARCHAR(50) NOT NULL, ADD prenom VARCHAR(25) NOT NULL, ADD adresse VARCHAR(50) NOT NULL, ADD permis TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fiche_de_paie DROP FOREIGN KEY FK_B3236E135C5185E5');
        $this->addSql('DROP TABLE fiche_de_paie');
        $this->addSql('DROP TABLE roles');
        $this->addSql('ALTER TABLE employer DROP nom, DROP prenom, DROP adresse, DROP permis');
    }
}
