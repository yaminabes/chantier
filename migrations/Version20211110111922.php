<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211110111922 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chantier (id INT AUTO_INCREMENT NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, adresse VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE conducteur_travaux (id INT AUTO_INCREMENT NOT NULL, numero_matricule VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE maitre_ouvrage (id INT AUTO_INCREMENT NOT NULL, numero_client VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestataires (id INT AUTO_INCREMENT NOT NULL, siret VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_batiment (id INT AUTO_INCREMENT NOT NULL, nom_type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD role_user VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6498F5F6093 FOREIGN KEY (maitre_ouvrage_id) REFERENCES maitre_ouvrage (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64944D37739 FOREIGN KEY (conducteur_traveaux_id) REFERENCES conducteur_travaux (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649BE3DB2B7 FOREIGN KEY (prestataire_id) REFERENCES prestataires (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6498F5F6093 ON user (maitre_ouvrage_id)');
        $this->addSql('CREATE INDEX IDX_8D93D64944D37739 ON user (conducteur_traveaux_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649BE3DB2B7 ON user (prestataire_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D64944D37739');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6498F5F6093');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649BE3DB2B7');
        $this->addSql('DROP TABLE chantier');
        $this->addSql('DROP TABLE conducteur_travaux');
        $this->addSql('DROP TABLE maitre_ouvrage');
        $this->addSql('DROP TABLE prestataires');
        $this->addSql('DROP TABLE type_batiment');
        $this->addSql('DROP INDEX IDX_8D93D6498F5F6093 ON `user`');
        $this->addSql('DROP INDEX IDX_8D93D64944D37739 ON `user`');
        $this->addSql('DROP INDEX IDX_8D93D649BE3DB2B7 ON `user`');
        $this->addSql('ALTER TABLE `user` DROP role_user');
    }
}
