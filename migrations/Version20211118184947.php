<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211118184947 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_9387207599091188');
        $this->addSql('DROP INDEX IDX_9387207599091188 ON tache');
        $this->addSql('ALTER TABLE tache DROP phase_id');
        $this->addSql('ALTER TABLE user ADD role_user VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tache ADD phase_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_9387207599091188 FOREIGN KEY (phase_id) REFERENCES phase (id)');
        $this->addSql('CREATE INDEX IDX_9387207599091188 ON tache (phase_id)');
        $this->addSql('ALTER TABLE `user` DROP role_user');
    }
}
