<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240725164750 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE caisse_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE consultation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE examen_clinique_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE facturation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE hospitalisation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE infirmiere_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE laboratin_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE ligne_prescription_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE medecin_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE medicament_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE mode_paiement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE patient_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pharmacien_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE prescription_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE prise_service_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE rdv_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE receptioniste_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE soins_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE stock_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE caisse (id INT NOT NULL, user_create VARCHAR(255) DEFAULT NULL, user_update VARCHAR(255) DEFAULT NULL, user_delete VARCHAR(255) DEFAULT NULL, date_create TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_update TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_delete TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, nom_caisse VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE consultation (id INT NOT NULL, patient_id INT DEFAULT NULL, medecin_id INT NOT NULL, user_create VARCHAR(255) DEFAULT NULL, user_update VARCHAR(255) DEFAULT NULL, user_delete VARCHAR(255) DEFAULT NULL, date_create TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_update TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_delete TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, motif VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, resultat VARCHAR(255) NOT NULL, poids VARCHAR(255) NOT NULL, taille VARCHAR(255) NOT NULL, temperature VARCHAR(255) NOT NULL, frequence_cardiaque VARCHAR(255) NOT NULL, tension VARCHAR(255) NOT NULL, pression_respiratoire VARCHAR(255) NOT NULL, diurese VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_964685A66B899279 ON consultation (patient_id)');
        $this->addSql('CREATE INDEX IDX_964685A64F31A84 ON consultation (medecin_id)');
        $this->addSql('CREATE TABLE examen_clinique (id INT NOT NULL, consultation_id INT NOT NULL, laboratin_id INT DEFAULT NULL, user_create VARCHAR(255) DEFAULT NULL, user_update VARCHAR(255) DEFAULT NULL, user_delete VARCHAR(255) DEFAULT NULL, date_create TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_update TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_delete TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, type VARCHAR(255) NOT NULL, resultat VARCHAR(255) NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3E840F2262FF6CDF ON examen_clinique (consultation_id)');
        $this->addSql('CREATE INDEX IDX_3E840F2214C32363 ON examen_clinique (laboratin_id)');
        $this->addSql('CREATE TABLE facturation (id INT NOT NULL, mode_paiement_id INT NOT NULL, caisse_id INT NOT NULL, consultation_id INT NOT NULL, user_create VARCHAR(255) DEFAULT NULL, user_update VARCHAR(255) DEFAULT NULL, user_delete VARCHAR(255) DEFAULT NULL, date_create TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_update TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_delete TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, montant DOUBLE PRECISION NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_17EB513A438F5B63 ON facturation (mode_paiement_id)');
        $this->addSql('CREATE INDEX IDX_17EB513A27B4FEBF ON facturation (caisse_id)');
        $this->addSql('CREATE INDEX IDX_17EB513A62FF6CDF ON facturation (consultation_id)');
        $this->addSql('CREATE TABLE hospitalisation (id INT NOT NULL, consultation_id INT NOT NULL, user_create VARCHAR(255) DEFAULT NULL, user_update VARCHAR(255) DEFAULT NULL, user_delete VARCHAR(255) DEFAULT NULL, date_create TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_update TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_delete TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_entre TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_sortie TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, chambre VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_67C0595962FF6CDF ON hospitalisation (consultation_id)');
        $this->addSql('CREATE TABLE infirmiere (id INT NOT NULL, user_create VARCHAR(255) DEFAULT NULL, user_update VARCHAR(255) DEFAULT NULL, user_delete VARCHAR(255) DEFAULT NULL, date_create TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_update TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_delete TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE laboratin (id INT NOT NULL, user_create VARCHAR(255) DEFAULT NULL, user_update VARCHAR(255) DEFAULT NULL, user_delete VARCHAR(255) DEFAULT NULL, date_create TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_update TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_delete TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE ligne_prescription (id INT NOT NULL, prescription_id INT NOT NULL, stock_id INT NOT NULL, user_create VARCHAR(255) DEFAULT NULL, user_update VARCHAR(255) DEFAULT NULL, user_delete VARCHAR(255) DEFAULT NULL, date_create TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_update TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_delete TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, libelle VARCHAR(255) NOT NULL, quantite INT NOT NULL, posologie VARCHAR(255) NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A761F81693DB413D ON ligne_prescription (prescription_id)');
        $this->addSql('CREATE INDEX IDX_A761F816DCD6110 ON ligne_prescription (stock_id)');
        $this->addSql('CREATE TABLE medecin (id INT NOT NULL, user_create VARCHAR(255) DEFAULT NULL, user_update VARCHAR(255) DEFAULT NULL, user_delete VARCHAR(255) DEFAULT NULL, date_create TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_update TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_delete TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, age INT NOT NULL, adresse VARCHAR(255) NOT NULL, specialite VARCHAR(255) NOT NULL, telephone VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE medicament (id INT NOT NULL, user_create VARCHAR(255) DEFAULT NULL, user_update VARCHAR(255) DEFAULT NULL, user_delete VARCHAR(255) DEFAULT NULL, date_create TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_update TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_delete TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE mode_paiement (id INT NOT NULL, user_create VARCHAR(255) DEFAULT NULL, user_update VARCHAR(255) DEFAULT NULL, user_delete VARCHAR(255) DEFAULT NULL, date_create TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_update TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_delete TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, type_paiement VARCHAR(255) NOT NULL, mwthode VARCHAR(255) NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE patient (id INT NOT NULL, user_create VARCHAR(255) DEFAULT NULL, user_update VARCHAR(255) DEFAULT NULL, user_delete VARCHAR(255) DEFAULT NULL, date_create TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_update TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_delete TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, age INT NOT NULL, sex VARCHAR(255) NOT NULL, gs VARCHAR(255) NOT NULL, mobile VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE pharmacien (id INT NOT NULL, user_create VARCHAR(255) DEFAULT NULL, user_update VARCHAR(255) DEFAULT NULL, user_delete VARCHAR(255) DEFAULT NULL, date_create TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_update TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_delete TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE prescription (id INT NOT NULL, consultation_id INT DEFAULT NULL, pharmacien_id INT DEFAULT NULL, user_create VARCHAR(255) DEFAULT NULL, user_update VARCHAR(255) DEFAULT NULL, user_delete VARCHAR(255) DEFAULT NULL, date_create TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_update TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_delete TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, description VARCHAR(255) NOT NULL, posologie VARCHAR(255) NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1FBFB8D962FF6CDF ON prescription (consultation_id)');
        $this->addSql('CREATE INDEX IDX_1FBFB8D9CFDB96BE ON prescription (pharmacien_id)');
        $this->addSql('CREATE TABLE prise_service (id INT NOT NULL, caisse_id INT NOT NULL, user_create VARCHAR(255) DEFAULT NULL, user_update VARCHAR(255) DEFAULT NULL, user_delete VARCHAR(255) DEFAULT NULL, date_create TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_update TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_delete TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_debut TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_fin TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_AD15D36627B4FEBF ON prise_service (caisse_id)');
        $this->addSql('CREATE TABLE rdv (id INT NOT NULL, user_create VARCHAR(255) DEFAULT NULL, user_update VARCHAR(255) DEFAULT NULL, user_delete VARCHAR(255) DEFAULT NULL, date_create TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_update TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_delete TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_prise TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_rdv TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, motif VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE receptioniste (id INT NOT NULL, prise_service_id INT NOT NULL, user_create VARCHAR(255) DEFAULT NULL, user_update VARCHAR(255) DEFAULT NULL, user_delete VARCHAR(255) DEFAULT NULL, date_create TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_update TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_delete TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E4F0CDD7EDD30038 ON receptioniste (prise_service_id)');
        $this->addSql('CREATE TABLE soins (id INT NOT NULL, infirmiere_id INT NOT NULL, hospitalisation_id INT NOT NULL, user_create VARCHAR(255) DEFAULT NULL, user_update VARCHAR(255) DEFAULT NULL, user_delete VARCHAR(255) DEFAULT NULL, date_create TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_update TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_delete TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, frequence_cardiaque VARCHAR(255) NOT NULL, pression_artérielle VARCHAR(255) NOT NULL, température VARCHAR(255) NOT NULL, pression_respiratoire VARCHAR(255) NOT NULL, diurèse VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6E611C5717A43BB9 ON soins (infirmiere_id)');
        $this->addSql('CREATE INDEX IDX_6E611C57F531F4C5 ON soins (hospitalisation_id)');
        $this->addSql('CREATE TABLE stock (id INT NOT NULL, medicament_id INT NOT NULL, user_create VARCHAR(255) DEFAULT NULL, user_update VARCHAR(255) DEFAULT NULL, user_delete VARCHAR(255) DEFAULT NULL, date_create TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_update TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_delete TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, quantite INT NOT NULL, prix INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4B365660AB0D61F7 ON stock (medicament_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(64) NOT NULL, is_verified BOOLEAN NOT NULL, user_create VARCHAR(255) DEFAULT NULL, user_update VARCHAR(255) DEFAULT NULL, user_delete VARCHAR(255) DEFAULT NULL, date_create TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_update TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_delete TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_USERNAME ON "user" (username)');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A66B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A64F31A84 FOREIGN KEY (medecin_id) REFERENCES medecin (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE examen_clinique ADD CONSTRAINT FK_3E840F2262FF6CDF FOREIGN KEY (consultation_id) REFERENCES consultation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE examen_clinique ADD CONSTRAINT FK_3E840F2214C32363 FOREIGN KEY (laboratin_id) REFERENCES laboratin (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE facturation ADD CONSTRAINT FK_17EB513A438F5B63 FOREIGN KEY (mode_paiement_id) REFERENCES mode_paiement (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE facturation ADD CONSTRAINT FK_17EB513A27B4FEBF FOREIGN KEY (caisse_id) REFERENCES caisse (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE facturation ADD CONSTRAINT FK_17EB513A62FF6CDF FOREIGN KEY (consultation_id) REFERENCES consultation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE hospitalisation ADD CONSTRAINT FK_67C0595962FF6CDF FOREIGN KEY (consultation_id) REFERENCES consultation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ligne_prescription ADD CONSTRAINT FK_A761F81693DB413D FOREIGN KEY (prescription_id) REFERENCES prescription (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ligne_prescription ADD CONSTRAINT FK_A761F816DCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE prescription ADD CONSTRAINT FK_1FBFB8D962FF6CDF FOREIGN KEY (consultation_id) REFERENCES consultation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE prescription ADD CONSTRAINT FK_1FBFB8D9CFDB96BE FOREIGN KEY (pharmacien_id) REFERENCES pharmacien (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE prise_service ADD CONSTRAINT FK_AD15D36627B4FEBF FOREIGN KEY (caisse_id) REFERENCES caisse (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE receptioniste ADD CONSTRAINT FK_E4F0CDD7EDD30038 FOREIGN KEY (prise_service_id) REFERENCES prise_service (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE soins ADD CONSTRAINT FK_6E611C5717A43BB9 FOREIGN KEY (infirmiere_id) REFERENCES infirmiere (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE soins ADD CONSTRAINT FK_6E611C57F531F4C5 FOREIGN KEY (hospitalisation_id) REFERENCES hospitalisation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660AB0D61F7 FOREIGN KEY (medicament_id) REFERENCES medicament (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE caisse_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE consultation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE examen_clinique_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE facturation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE hospitalisation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE infirmiere_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE laboratin_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ligne_prescription_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE medecin_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE medicament_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE mode_paiement_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE patient_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pharmacien_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE prescription_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE prise_service_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE rdv_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE receptioniste_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE soins_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE stock_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('ALTER TABLE consultation DROP CONSTRAINT FK_964685A66B899279');
        $this->addSql('ALTER TABLE consultation DROP CONSTRAINT FK_964685A64F31A84');
        $this->addSql('ALTER TABLE examen_clinique DROP CONSTRAINT FK_3E840F2262FF6CDF');
        $this->addSql('ALTER TABLE examen_clinique DROP CONSTRAINT FK_3E840F2214C32363');
        $this->addSql('ALTER TABLE facturation DROP CONSTRAINT FK_17EB513A438F5B63');
        $this->addSql('ALTER TABLE facturation DROP CONSTRAINT FK_17EB513A27B4FEBF');
        $this->addSql('ALTER TABLE facturation DROP CONSTRAINT FK_17EB513A62FF6CDF');
        $this->addSql('ALTER TABLE hospitalisation DROP CONSTRAINT FK_67C0595962FF6CDF');
        $this->addSql('ALTER TABLE ligne_prescription DROP CONSTRAINT FK_A761F81693DB413D');
        $this->addSql('ALTER TABLE ligne_prescription DROP CONSTRAINT FK_A761F816DCD6110');
        $this->addSql('ALTER TABLE prescription DROP CONSTRAINT FK_1FBFB8D962FF6CDF');
        $this->addSql('ALTER TABLE prescription DROP CONSTRAINT FK_1FBFB8D9CFDB96BE');
        $this->addSql('ALTER TABLE prise_service DROP CONSTRAINT FK_AD15D36627B4FEBF');
        $this->addSql('ALTER TABLE receptioniste DROP CONSTRAINT FK_E4F0CDD7EDD30038');
        $this->addSql('ALTER TABLE soins DROP CONSTRAINT FK_6E611C5717A43BB9');
        $this->addSql('ALTER TABLE soins DROP CONSTRAINT FK_6E611C57F531F4C5');
        $this->addSql('ALTER TABLE stock DROP CONSTRAINT FK_4B365660AB0D61F7');
        $this->addSql('DROP TABLE caisse');
        $this->addSql('DROP TABLE consultation');
        $this->addSql('DROP TABLE examen_clinique');
        $this->addSql('DROP TABLE facturation');
        $this->addSql('DROP TABLE hospitalisation');
        $this->addSql('DROP TABLE infirmiere');
        $this->addSql('DROP TABLE laboratin');
        $this->addSql('DROP TABLE ligne_prescription');
        $this->addSql('DROP TABLE medecin');
        $this->addSql('DROP TABLE medicament');
        $this->addSql('DROP TABLE mode_paiement');
        $this->addSql('DROP TABLE patient');
        $this->addSql('DROP TABLE pharmacien');
        $this->addSql('DROP TABLE prescription');
        $this->addSql('DROP TABLE prise_service');
        $this->addSql('DROP TABLE rdv');
        $this->addSql('DROP TABLE receptioniste');
        $this->addSql('DROP TABLE soins');
        $this->addSql('DROP TABLE stock');
        $this->addSql('DROP TABLE "user"');
    }
}
