<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211114150905 extends AbstractMigration
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
        $this->addSql('CREATE TABLE materiaux (id INT AUTO_INCREMENT NOT NULL, unite_id INT DEFAULT NULL, nom_materiaux VARCHAR(255) NOT NULL, INDEX IDX_97C56625EC4A74AB (unite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE materiaux_necessaires (id INT AUTO_INCREMENT NOT NULL, materiaux_id INT NOT NULL, tache_id INT DEFAULT NULL, quantite_prevue DOUBLE PRECISION NOT NULL, quantite_utilisee VARCHAR(255) NOT NULL, INDEX IDX_C19B28D0806EBBB2 (materiaux_id), INDEX IDX_C19B28D0D2235D39 (tache_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE phase (id INT AUTO_INCREMENT NOT NULL, nom_phase VARCHAR(255) NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statut_tache (id INT AUTO_INCREMENT NOT NULL, nom_statut VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tache (id INT AUTO_INCREMENT NOT NULL, statut_tache_id INT NOT NULL, prestataire_id INT DEFAULT NULL, metier_id INT DEFAULT NULL, phase_id INT DEFAULT NULL, nom_tache VARCHAR(255) NOT NULL, tarif_prestation DOUBLE PRECISION NOT NULL, INDEX IDX_93872075AD25E198 (statut_tache_id), INDEX IDX_93872075BE3DB2B7 (prestataire_id), INDEX IDX_93872075ED16FA20 (metier_id), INDEX IDX_9387207599091188 (phase_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fournisseur_materiaux ADD CONSTRAINT FK_6A0F2A40670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fournisseur_materiaux ADD CONSTRAINT FK_6A0F2A40806EBBB2 FOREIGN KEY (materiaux_id) REFERENCES materiaux (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE materiaux ADD CONSTRAINT FK_97C56625EC4A74AB FOREIGN KEY (unite_id) REFERENCES unite (id)');
        $this->addSql('ALTER TABLE materiaux_necessaires ADD CONSTRAINT FK_C19B28D0806EBBB2 FOREIGN KEY (materiaux_id) REFERENCES materiaux (id)');
        $this->addSql('ALTER TABLE materiaux_necessaires ADD CONSTRAINT FK_C19B28D0D2235D39 FOREIGN KEY (tache_id) REFERENCES tache (id)');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075AD25E198 FOREIGN KEY (statut_tache_id) REFERENCES tache (id)');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075BE3DB2B7 FOREIGN KEY (prestataire_id) REFERENCES prestataire (id)');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075ED16FA20 FOREIGN KEY (metier_id) REFERENCES metier (id)');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_9387207599091188 FOREIGN KEY (phase_id) REFERENCES phase (id)');
        $this->addSql('DROP TABLE prestataires');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D806EBBB2 FOREIGN KEY (materiaux_id) REFERENCES materiaux (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D7F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410EE042C0A FOREIGN KEY (conducteur_travaux_id) REFERENCES conducteur_travaux (id)');
        $this->addSql('ALTER TABLE phase_chantier ADD CONSTRAINT FK_277B6E2899091188 FOREIGN KEY (phase_id) REFERENCES phase (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE phase_chantier ADD CONSTRAINT FK_277B6E28D0C0049D FOREIGN KEY (chantier_id) REFERENCES chantier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prestataire ADD siret VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE propose ADD CONSTRAINT FK_3DF2D060806EBBB2 FOREIGN KEY (materiaux_id) REFERENCES materiaux (id)');
        $this->addSql('ALTER TABLE propose ADD CONSTRAINT FK_3DF2D060670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660806EBBB2 FOREIGN KEY (materiaux_id) REFERENCES materiaux (id)');
        $this->addSql('ALTER TABLE stock_tache_utilise ADD CONSTRAINT FK_665869BEDCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id)');
        $this->addSql('ALTER TABLE stock_tache_utilise ADD CONSTRAINT FK_665869BED2235D39 FOREIGN KEY (tache_id) REFERENCES tache (id)');
        $this->addSql('ALTER TABLE user ADD nom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6498F5F6093 FOREIGN KEY (maitre_ouvrage_id) REFERENCES maitre_ouvrage (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64944D37739 FOREIGN KEY (conducteur_traveaux_id) REFERENCES conducteur_travaux (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649BE3DB2B7 FOREIGN KEY (prestataire_id) REFERENCES prestataire (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6498F5F6093 ON user (maitre_ouvrage_id)');
        $this->addSql('CREATE INDEX IDX_8D93D64944D37739 ON user (conducteur_traveaux_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649BE3DB2B7 ON user (prestataire_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410670C757F');
        $this->addSql('ALTER TABLE fournisseur_materiaux DROP FOREIGN KEY FK_6A0F2A40670C757F');
        $this->addSql('ALTER TABLE propose DROP FOREIGN KEY FK_3DF2D060670C757F');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D806EBBB2');
        $this->addSql('ALTER TABLE fournisseur_materiaux DROP FOREIGN KEY FK_6A0F2A40806EBBB2');
        $this->addSql('ALTER TABLE materiaux_necessaires DROP FOREIGN KEY FK_C19B28D0806EBBB2');
        $this->addSql('ALTER TABLE propose DROP FOREIGN KEY FK_3DF2D060806EBBB2');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B365660806EBBB2');
        $this->addSql('ALTER TABLE phase_chantier DROP FOREIGN KEY FK_277B6E2899091188');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_9387207599091188');
        $this->addSql('ALTER TABLE materiaux_necessaires DROP FOREIGN KEY FK_C19B28D0D2235D39');
        $this->addSql('ALTER TABLE stock_tache_utilise DROP FOREIGN KEY FK_665869BED2235D39');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_93872075AD25E198');
        $this->addSql('CREATE TABLE prestataires (id INT AUTO_INCREMENT NOT NULL, siret VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE fournisseur');
        $this->addSql('DROP TABLE fournisseur_materiaux');
        $this->addSql('DROP TABLE materiaux');
        $this->addSql('DROP TABLE materiaux_necessaires');
        $this->addSql('DROP TABLE phase');
        $this->addSql('DROP TABLE statut_tache');
        $this->addSql('DROP TABLE tache');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D7F2DEE08');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410EE042C0A');
        $this->addSql('ALTER TABLE phase_chantier DROP FOREIGN KEY FK_277B6E28D0C0049D');
        $this->addSql('ALTER TABLE prestataire DROP siret');
        $this->addSql('ALTER TABLE stock_tache_utilise DROP FOREIGN KEY FK_665869BEDCD6110');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6498F5F6093');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D64944D37739');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649BE3DB2B7');
        $this->addSql('DROP INDEX IDX_8D93D6498F5F6093 ON `user`');
        $this->addSql('DROP INDEX IDX_8D93D64944D37739 ON `user`');
        $this->addSql('DROP INDEX IDX_8D93D649BE3DB2B7 ON `user`');
        $this->addSql('ALTER TABLE `user` DROP nom');
    }
}
