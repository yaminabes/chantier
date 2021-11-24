<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211124093451 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE statut (id INT AUTO_INCREMENT NOT NULL, nom_statut VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE statut_tache');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_93872075AD25E198');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_9387207599091188');
        $this->addSql('DROP INDEX IDX_9387207599091188 ON tache');
        $this->addSql('DROP INDEX IDX_93872075AD25E198 ON tache');
        $this->addSql('ALTER TABLE tache DROP phase_id, CHANGE statut_tache_id statut_id INT NOT NULL');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075F6203804 FOREIGN KEY (statut_id) REFERENCES statut (id)');
        $this->addSql('CREATE INDEX IDX_93872075F6203804 ON tache (statut_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_93872075F6203804');
        $this->addSql('CREATE TABLE statut_tache (id INT AUTO_INCREMENT NOT NULL, nom_statut VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE statut');
        $this->addSql('DROP INDEX IDX_93872075F6203804 ON tache');
        $this->addSql('ALTER TABLE tache ADD phase_id INT DEFAULT NULL, CHANGE statut_id statut_tache_id INT NOT NULL');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075AD25E198 FOREIGN KEY (statut_tache_id) REFERENCES tache (id)');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_9387207599091188 FOREIGN KEY (phase_id) REFERENCES phase (id)');
        $this->addSql('CREATE INDEX IDX_9387207599091188 ON tache (phase_id)');
        $this->addSql('CREATE INDEX IDX_93872075AD25E198 ON tache (statut_tache_id)');
    }
}
