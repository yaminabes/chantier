<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211112181515 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE unite (id INT AUTO_INCREMENT NOT NULL, nom_unite VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
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
        $this->addSql('DROP TABLE unite');
        $this->addSql('ALTER TABLE fournisseur_materiaux DROP FOREIGN KEY FK_6A0F2A40670C757F');
        $this->addSql('ALTER TABLE fournisseur_materiaux DROP FOREIGN KEY FK_6A0F2A40806EBBB2');
        $this->addSql('ALTER TABLE materiaux_necessaires DROP FOREIGN KEY FK_C19B28D0806EBBB2');
        $this->addSql('ALTER TABLE materiaux_necessaires DROP FOREIGN KEY FK_C19B28D0D2235D39');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_93872075AD25E198');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_93872075BE3DB2B7');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_93872075ED16FA20');
        $this->addSql('ALTER TABLE `user` DROP nom');
    }
}
