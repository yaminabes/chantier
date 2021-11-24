<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211124102921 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chantier (id INT AUTO_INCREMENT NOT NULL, conducteur_travaux_id INT DEFAULT NULL, maitre_ouvrage_id INT DEFAULT NULL, type_batiment_id INT DEFAULT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, adresse VARCHAR(255) DEFAULT NULL, INDEX IDX_636F27F6EE042C0A (conducteur_travaux_id), INDEX IDX_636F27F68F5F6093 (maitre_ouvrage_id), INDEX IDX_636F27F69DEF5E8A (type_batiment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, materiaux_id INT DEFAULT NULL, facture_id INT DEFAULT NULL, quantite DOUBLE PRECISION NOT NULL, INDEX IDX_6EEAA67D806EBBB2 (materiaux_id), INDEX IDX_6EEAA67D7F2DEE08 (facture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE conducteur_travaux (id INT AUTO_INCREMENT NOT NULL, numero_matricule VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, fournisseur_id INT DEFAULT NULL, conducteur_travaux_id INT DEFAULT NULL, INDEX IDX_FE866410670C757F (fournisseur_id), INDEX IDX_FE866410EE042C0A (conducteur_travaux_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournisseur (id INT AUTO_INCREMENT NOT NULL, nom_fournisseur VARCHAR(255) NOT NULL, siret VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournisseur_materiaux (fournisseur_id INT NOT NULL, materiaux_id INT NOT NULL, INDEX IDX_6A0F2A40670C757F (fournisseur_id), INDEX IDX_6A0F2A40806EBBB2 (materiaux_id), PRIMARY KEY(fournisseur_id, materiaux_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE maitre_ouvrage (id INT AUTO_INCREMENT NOT NULL, numero_client VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE materiaux (id INT AUTO_INCREMENT NOT NULL, unite_id INT DEFAULT NULL, nom_materiaux VARCHAR(255) NOT NULL, INDEX IDX_97C56625EC4A74AB (unite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE materiaux_necessaires (id INT AUTO_INCREMENT NOT NULL, materiaux_id INT NOT NULL, tache_id INT DEFAULT NULL, quantite_prevue DOUBLE PRECISION NOT NULL, quantite_utilisee VARCHAR(255) NOT NULL, INDEX IDX_C19B28D0806EBBB2 (materiaux_id), INDEX IDX_C19B28D0D2235D39 (tache_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE metier (id INT AUTO_INCREMENT NOT NULL, corps_metier VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE metier_prestataire (metier_id INT NOT NULL, prestataire_id INT NOT NULL, INDEX IDX_5C37E6FCED16FA20 (metier_id), INDEX IDX_5C37E6FCBE3DB2B7 (prestataire_id), PRIMARY KEY(metier_id, prestataire_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE phase (id INT AUTO_INCREMENT NOT NULL, nom_phase VARCHAR(255) NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE phase_chantier (phase_id INT NOT NULL, chantier_id INT NOT NULL, INDEX IDX_277B6E2899091188 (phase_id), INDEX IDX_277B6E28D0C0049D (chantier_id), PRIMARY KEY(phase_id, chantier_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestataire (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, siret VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE propose (id INT AUTO_INCREMENT NOT NULL, materiaux_id INT DEFAULT NULL, fournisseur_id INT DEFAULT NULL, cout DOUBLE PRECISION NOT NULL, INDEX IDX_3DF2D060806EBBB2 (materiaux_id), INDEX IDX_3DF2D060670C757F (fournisseur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock (id INT AUTO_INCREMENT NOT NULL, materiaux_id INT DEFAULT NULL, quantite DOUBLE PRECISION NOT NULL, INDEX IDX_4B365660806EBBB2 (materiaux_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock_tache_utilise (id INT AUTO_INCREMENT NOT NULL, stock_id INT DEFAULT NULL, tache_id INT DEFAULT NULL, INDEX IDX_665869BEDCD6110 (stock_id), INDEX IDX_665869BED2235D39 (tache_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tache (id INT AUTO_INCREMENT NOT NULL, prestataire_id INT DEFAULT NULL, metier_id INT DEFAULT NULL, statut_id INT NOT NULL, nom_tache VARCHAR(255) NOT NULL, tarif_prestation DOUBLE PRECISION NOT NULL, INDEX IDX_93872075BE3DB2B7 (prestataire_id), INDEX IDX_93872075ED16FA20 (metier_id), INDEX IDX_93872075F6203804 (statut_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tache_phase (tache_id INT NOT NULL, phase_id INT NOT NULL, INDEX IDX_2E70010AD2235D39 (tache_id), INDEX IDX_2E70010A99091188 (phase_id), PRIMARY KEY(tache_id, phase_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_batiment (id INT AUTO_INCREMENT NOT NULL, nom_type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unite (id INT AUTO_INCREMENT NOT NULL, nom_unite VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, maitre_ouvrage_id INT DEFAULT NULL, conducteur_traveaux_id INT DEFAULT NULL, prestataire_id INT DEFAULT NULL, email VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, num_tel VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', nom VARCHAR(255) NOT NULL, role_user VARCHAR(255) NOT NULL, INDEX IDX_8D93D6498F5F6093 (maitre_ouvrage_id), INDEX IDX_8D93D64944D37739 (conducteur_traveaux_id), INDEX IDX_8D93D649BE3DB2B7 (prestataire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE chantier ADD CONSTRAINT FK_636F27F6EE042C0A FOREIGN KEY (conducteur_travaux_id) REFERENCES conducteur_travaux (id)');
        $this->addSql('ALTER TABLE chantier ADD CONSTRAINT FK_636F27F68F5F6093 FOREIGN KEY (maitre_ouvrage_id) REFERENCES maitre_ouvrage (id)');
        $this->addSql('ALTER TABLE chantier ADD CONSTRAINT FK_636F27F69DEF5E8A FOREIGN KEY (type_batiment_id) REFERENCES type_batiment (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D806EBBB2 FOREIGN KEY (materiaux_id) REFERENCES materiaux (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D7F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410EE042C0A FOREIGN KEY (conducteur_travaux_id) REFERENCES conducteur_travaux (id)');
        $this->addSql('ALTER TABLE fournisseur_materiaux ADD CONSTRAINT FK_6A0F2A40670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fournisseur_materiaux ADD CONSTRAINT FK_6A0F2A40806EBBB2 FOREIGN KEY (materiaux_id) REFERENCES materiaux (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE materiaux ADD CONSTRAINT FK_97C56625EC4A74AB FOREIGN KEY (unite_id) REFERENCES unite (id)');
        $this->addSql('ALTER TABLE materiaux_necessaires ADD CONSTRAINT FK_C19B28D0806EBBB2 FOREIGN KEY (materiaux_id) REFERENCES materiaux (id)');
        $this->addSql('ALTER TABLE materiaux_necessaires ADD CONSTRAINT FK_C19B28D0D2235D39 FOREIGN KEY (tache_id) REFERENCES tache (id)');
        $this->addSql('ALTER TABLE metier_prestataire ADD CONSTRAINT FK_5C37E6FCED16FA20 FOREIGN KEY (metier_id) REFERENCES metier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE metier_prestataire ADD CONSTRAINT FK_5C37E6FCBE3DB2B7 FOREIGN KEY (prestataire_id) REFERENCES prestataire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE phase_chantier ADD CONSTRAINT FK_277B6E2899091188 FOREIGN KEY (phase_id) REFERENCES phase (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE phase_chantier ADD CONSTRAINT FK_277B6E28D0C0049D FOREIGN KEY (chantier_id) REFERENCES chantier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE propose ADD CONSTRAINT FK_3DF2D060806EBBB2 FOREIGN KEY (materiaux_id) REFERENCES materiaux (id)');
        $this->addSql('ALTER TABLE propose ADD CONSTRAINT FK_3DF2D060670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660806EBBB2 FOREIGN KEY (materiaux_id) REFERENCES materiaux (id)');
        $this->addSql('ALTER TABLE stock_tache_utilise ADD CONSTRAINT FK_665869BEDCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id)');
        $this->addSql('ALTER TABLE stock_tache_utilise ADD CONSTRAINT FK_665869BED2235D39 FOREIGN KEY (tache_id) REFERENCES tache (id)');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075BE3DB2B7 FOREIGN KEY (prestataire_id) REFERENCES prestataire (id)');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075ED16FA20 FOREIGN KEY (metier_id) REFERENCES metier (id)');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075F6203804 FOREIGN KEY (statut_id) REFERENCES statut (id)');
        $this->addSql('ALTER TABLE tache_phase ADD CONSTRAINT FK_2E70010AD2235D39 FOREIGN KEY (tache_id) REFERENCES tache (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tache_phase ADD CONSTRAINT FK_2E70010A99091188 FOREIGN KEY (phase_id) REFERENCES phase (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D6498F5F6093 FOREIGN KEY (maitre_ouvrage_id) REFERENCES maitre_ouvrage (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D64944D37739 FOREIGN KEY (conducteur_traveaux_id) REFERENCES conducteur_travaux (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649BE3DB2B7 FOREIGN KEY (prestataire_id) REFERENCES prestataire (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE phase_chantier DROP FOREIGN KEY FK_277B6E28D0C0049D');
        $this->addSql('ALTER TABLE chantier DROP FOREIGN KEY FK_636F27F6EE042C0A');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410EE042C0A');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D64944D37739');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D7F2DEE08');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410670C757F');
        $this->addSql('ALTER TABLE fournisseur_materiaux DROP FOREIGN KEY FK_6A0F2A40670C757F');
        $this->addSql('ALTER TABLE propose DROP FOREIGN KEY FK_3DF2D060670C757F');
        $this->addSql('ALTER TABLE chantier DROP FOREIGN KEY FK_636F27F68F5F6093');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6498F5F6093');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D806EBBB2');
        $this->addSql('ALTER TABLE fournisseur_materiaux DROP FOREIGN KEY FK_6A0F2A40806EBBB2');
        $this->addSql('ALTER TABLE materiaux_necessaires DROP FOREIGN KEY FK_C19B28D0806EBBB2');
        $this->addSql('ALTER TABLE propose DROP FOREIGN KEY FK_3DF2D060806EBBB2');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B365660806EBBB2');
        $this->addSql('ALTER TABLE metier_prestataire DROP FOREIGN KEY FK_5C37E6FCED16FA20');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_93872075ED16FA20');
        $this->addSql('ALTER TABLE phase_chantier DROP FOREIGN KEY FK_277B6E2899091188');
        $this->addSql('ALTER TABLE tache_phase DROP FOREIGN KEY FK_2E70010A99091188');
        $this->addSql('ALTER TABLE metier_prestataire DROP FOREIGN KEY FK_5C37E6FCBE3DB2B7');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_93872075BE3DB2B7');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649BE3DB2B7');
        $this->addSql('ALTER TABLE stock_tache_utilise DROP FOREIGN KEY FK_665869BEDCD6110');
        $this->addSql('ALTER TABLE materiaux_necessaires DROP FOREIGN KEY FK_C19B28D0D2235D39');
        $this->addSql('ALTER TABLE stock_tache_utilise DROP FOREIGN KEY FK_665869BED2235D39');
        $this->addSql('ALTER TABLE tache_phase DROP FOREIGN KEY FK_2E70010AD2235D39');
        $this->addSql('ALTER TABLE chantier DROP FOREIGN KEY FK_636F27F69DEF5E8A');
        $this->addSql('ALTER TABLE materiaux DROP FOREIGN KEY FK_97C56625EC4A74AB');
        $this->addSql('DROP TABLE chantier');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE conducteur_travaux');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE fournisseur');
        $this->addSql('DROP TABLE fournisseur_materiaux');
        $this->addSql('DROP TABLE maitre_ouvrage');
        $this->addSql('DROP TABLE materiaux');
        $this->addSql('DROP TABLE materiaux_necessaires');
        $this->addSql('DROP TABLE metier');
        $this->addSql('DROP TABLE metier_prestataire');
        $this->addSql('DROP TABLE phase');
        $this->addSql('DROP TABLE phase_chantier');
        $this->addSql('DROP TABLE prestataire');
        $this->addSql('DROP TABLE propose');
        $this->addSql('DROP TABLE stock');
        $this->addSql('DROP TABLE stock_tache_utilise');
        $this->addSql('DROP TABLE tache');
        $this->addSql('DROP TABLE tache_phase');
        $this->addSql('DROP TABLE type_batiment');
        $this->addSql('DROP TABLE unite');
        $this->addSql('DROP TABLE `user`');
    }
}
