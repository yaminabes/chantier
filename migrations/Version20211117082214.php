<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211117082214 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tache_phase (tache_id INT NOT NULL, phase_id INT NOT NULL, INDEX IDX_2E70010AD2235D39 (tache_id), INDEX IDX_2E70010A99091188 (phase_id), PRIMARY KEY(tache_id, phase_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tache_phase ADD CONSTRAINT FK_2E70010AD2235D39 FOREIGN KEY (tache_id) REFERENCES tache (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tache_phase ADD CONSTRAINT FK_2E70010A99091188 FOREIGN KEY (phase_id) REFERENCES phase (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE prestataires');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_9387207599091188');
        $this->addSql('DROP INDEX IDX_9387207599091188 ON tache');
        $this->addSql('ALTER TABLE tache DROP phase_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE prestataires (id INT AUTO_INCREMENT NOT NULL, siret VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE tache_phase');
        $this->addSql('ALTER TABLE tache ADD phase_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_9387207599091188 FOREIGN KEY (phase_id) REFERENCES phase (id)');
        $this->addSql('CREATE INDEX IDX_9387207599091188 ON tache (phase_id)');
    }
}
