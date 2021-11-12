<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211112181255 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fournisseur (id INT AUTO_INCREMENT NOT NULL, nom_fournisseur VARCHAR(255) NOT NULL, siret VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournisseur_materiaux (fournisseur_id INT NOT NULL, materiaux_id INT NOT NULL, INDEX IDX_6A0F2A40670C757F (fournisseur_id), INDEX IDX_6A0F2A40806EBBB2 (materiaux_id), PRIMARY KEY(fournisseur_id, materiaux_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE materiaux (id INT AUTO_INCREMENT NOT NULL, nom_materiaux VARCHAR(255) NOT NULL, prix_unitaire DOUBLE PRECISION NOT NULL, stock DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE materiaux_necessaires (id INT AUTO_INCREMENT NOT NULL, materiaux_id INT NOT NULL, tache_id INT DEFAULT NULL, quantite_prevue DOUBLE PRECISION NOT NULL, quantite_utilisee VARCHAR(255) NOT NULL, INDEX IDX_C19B28D0806EBBB2 (materiaux_id), INDEX IDX_C19B28D0D2235D39 (tache_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE phase (id INT AUTO_INCREMENT NOT NULL, nom_phase VARCHAR(255) NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statut_tache (id INT AUTO_INCREMENT NOT NULL, nom_statut VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tache (id INT AUTO_INCREMENT NOT NULL, statut_tache_id INT NOT NULL, prestataire_id INT DEFAULT NULL, metier_id INT DEFAULT NULL, nom_tache VARCHAR(255) NOT NULL, tarif_prestation DOUBLE PRECISION NOT NULL, INDEX IDX_93872075AD25E198 (statut_tache_id), INDEX IDX_93872075BE3DB2B7 (prestataire_id), INDEX IDX_93872075ED16FA20 (metier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unite (id INT AUTO_INCREMENT NOT NULL, nomÃ_unite VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fournisseur_materiaux ADD CONSTRAINT FK_6A0F2A40670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fournisseur_materiaux ADD CONSTRAINT FK_6A0F2A40806EBBB2 FOREIGN KEY (materiaux_id) REFERENCES materiaux (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE materiaux_necessaires ADD CONSTRAINT FK_C19B28D0806EBBB2 FOREIGN KEY (materiaux_id) REFERENCES materiaux (id)');
        $this->addSql('ALTER TABLE materiaux_necessaires ADD CONSTRAINT FK_C19B28D0D2235D39 FOREIGN KEY (tache_id) REFERENCES tache (id)');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075AD25E198 FOREIGN KEY (statut_tache_id) REFERENCES tache (id)');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075BE3DB2B7 FOREIGN KEY (prestataire_id) REFERENCES prestataire (id)');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075ED16FA20 FOREIGN KEY (metier_id) REFERENCES metier (id)');
        $this->addSql('ALTER TABLE user ADD nom VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fournisseur_materiaux DROP FOREIGN KEY FK_6A0F2A40670C757F');
        $this->addSql('ALTER TABLE fournisseur_materiaux DROP FOREIGN KEY FK_6A0F2A40806EBBB2');
        $this->addSql('ALTER TABLE materiaux_necessaires DROP FOREIGN KEY FK_C19B28D0806EBBB2');
        $this->addSql('ALTER TABLE materiaux_necessaires DROP FOREIGN KEY FK_C19B28D0D2235D39');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_93872075AD25E198');
        $this->addSql('DROP TABLE fournisseur');
        $this->addSql('DROP TABLE fournisseur_materiaux');
        $this->addSql('DROP TABLE materiaux');
        $this->addSql('DROP TABLE materiaux_necessaires');
        $this->addSql('DROP TABLE phase');
        $this->addSql('DROP TABLE statut_tache');
        $this->addSql('DROP TABLE tache');
        $this->addSql('DROP TABLE unite');
        $this->addSql('ALTER TABLE `user` DROP nom');
    }
}
