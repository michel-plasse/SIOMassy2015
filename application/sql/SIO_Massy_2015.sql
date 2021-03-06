DELIMITER $$
DROP SCHEMA IF EXISTS db524752934 $$
CREATE SCHEMA IF NOT EXISTS db524752934 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci $$
USE db524752934 $$

-- Lever temporairement les contraintes d'intégrité
SET FOREIGN_KEY_CHECKS=0 $$
DROP TABLE IF EXISTS personne $$
DROP TABLE IF EXISTS bilan $$
DROP TABLE IF EXISTS bulletin $$
DROP TABLE IF EXISTS candidature $$
DROP TABLE IF EXISTS etat_candidature $$
DROP TABLE IF EXISTS evaluation $$
DROP TABLE IF EXISTS formateur $$
DROP TABLE IF EXISTS formation $$
DROP TABLE IF EXISTS intervenant $$
DROP TABLE IF EXISTS ligne_bulletin $$
DROP TABLE IF EXISTS module $$
DROP TABLE IF EXISTS module_formation $$
DROP TABLE IF EXISTS module_theme $$
DROP TABLE IF EXISTS note $$
DROP TABLE IF EXISTS personne $$
DROP TABLE IF EXISTS salle $$
DROP TABLE IF EXISTS seance $$
DROP TABLE IF EXISTS session $$
DROP TABLE IF EXISTS theme $$


-- -----------------------------------------------------
-- Table `db524752934`.`personne`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db524752934`.`personne` (
  `id_personne` INT NOT NULL AUTO_INCREMENT,
  `civilite` VARCHAR(3) NOT NULL,
  `prenom` VARCHAR(20) NOT NULL,
  `nom` VARCHAR(30) NOT NULL,
  `date_naissance` DATE NOT NULL,
  `adresse` VARCHAR(45) NULL,
  `code_postal` VARCHAR(5) NULL,
  `ville` VARCHAR(30) NULL,
  `telephone` VARCHAR(15) NULL,
  `telephone2` VARCHAR(15) NULL,
  `email` VARCHAR(30) NOT NULL,
  `mot_passe` VARCHAR(45) NOT NULL,
  `date_inscription` DATETIME NOT NULL COMMENT 'Date où la personne s\'est inscrite (avant la validation)',
  `est_inscrite` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'Vrai quand l\'inscription est valdée',
  PRIMARY KEY (`id_personne`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB $$


-- -----------------------------------------------------
-- Table `db524752934`.`module`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db524752934`.`module` (
  `id_module` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(128) NOT NULL,
  `objectif` VARCHAR(512) NULL,
  `contenu` VARCHAR(45) NULL,
  `nb_heures` INT NULL,
  `prerequis` VARCHAR(512) NULL,
  PRIMARY KEY (`id_module`))
ENGINE = InnoDB $$


-- -----------------------------------------------------
-- Table `db524752934`.`formation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db524752934`.`formation` (
  `id_formation` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NOT NULL,
  `description` TEXT NULL,
  PRIMARY KEY (`id_formation`))
ENGINE = InnoDB $$


-- -----------------------------------------------------
-- Table `db524752934`.`session`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db524752934`.`session` (
  `id_session` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NOT NULL,
  `date_debut` DATE NOT NULL,
  `date_fin` DATE NOT NULL,
  `description` TEXT NULL,
  `id_formation` INT NOT NULL,
  `date_debut_inscription` DATETIME NULL,
  `date_fin_inscription` DATETIME NULL,
  PRIMARY KEY (`id_session`),
  INDEX `fk_session_formation_idx` (`id_formation` ASC),
  CONSTRAINT `fk_session_formation`
    FOREIGN KEY (`id_formation`)
    REFERENCES `db524752934`.`formation` (`id_formation`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB $$


-- -----------------------------------------------------
-- Table `db524752934`.`formateur`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db524752934`.`formateur` (
  `id_formateur` INT NOT NULL,
  PRIMARY KEY (`id_formateur`),
  CONSTRAINT `fk_formateur_personne1`
    FOREIGN KEY (`id_formateur`)
    REFERENCES `db524752934`.`personne` (`id_personne`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB $$


-- -----------------------------------------------------
-- Table `db524752934`.`evaluation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db524752934`.`evaluation` (
  `id_evaluation` INT NOT NULL AUTO_INCREMENT,
  `id_module` INT NOT NULL,
  `id_session` INT NOT NULL,
  `id_formateur` INT NOT NULL,
  `date_effet` DATE NOT NULL,
  PRIMARY KEY (`id_evaluation`),
  INDEX `fk_evaluation_module1_idx` (`id_module` ASC),
  INDEX `fk_evaluation_session1_idx` (`id_session` ASC),
  INDEX `fk_evaluation_formateur1_idx` (`id_formateur` ASC),
  CONSTRAINT `fk_evaluation_module1`
    FOREIGN KEY (`id_module`)
    REFERENCES `db524752934`.`module` (`id_module`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_evaluation_session1`
    FOREIGN KEY (`id_session`)
    REFERENCES `db524752934`.`session` (`id_session`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_evaluation_formateur1`
    FOREIGN KEY (`id_formateur`)
    REFERENCES `db524752934`.`formateur` (`id_formateur`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB $$


-- -----------------------------------------------------
-- Table `db524752934`.`module_formation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db524752934`.`module_formation` (
  `id_module` INT NOT NULL,
  `id_formation` INT NOT NULL,
  PRIMARY KEY (`id_module`, `id_formation`),
  INDEX `fk_module_has_formation_formation1_idx` (`id_formation` ASC),
  INDEX `fk_module_has_formation_module1_idx` (`id_module` ASC),
  CONSTRAINT `fk_module_has_formation_module1`
    FOREIGN KEY (`id_module`)
    REFERENCES `db524752934`.`module` (`id_module`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_module_has_formation_formation1`
    FOREIGN KEY (`id_formation`)
    REFERENCES `db524752934`.`formation` (`id_formation`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB $$


-- -----------------------------------------------------
-- Table `db524752934`.`etat_candidature`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db524752934`.`etat_candidature` (
  `id_etat_candidature` CHAR(1) NOT NULL,
  `libelle` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_etat_candidature`))
ENGINE = InnoDB $$


-- -----------------------------------------------------
-- Table `db524752934`.`candidature`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db524752934`.`candidature` (
  `id_session` INT NOT NULL,
  `id_personne` INT NOT NULL,
  `id_etat_candidature` CHAR(1) NOT NULL,
  `date_effet` DATETIME NOT NULL,
  `motivation` TEXT NULL,
  PRIMARY KEY (`id_session`, `id_personne`),
  INDEX `fk_session_has_personne_personne1_idx` (`id_personne` ASC),
  INDEX `fk_session_has_personne_session1_idx` (`id_session` ASC),
  INDEX `fk_candidature_etat_candidature1_idx` (`id_etat_candidature` ASC),
  CONSTRAINT `fk_session_has_personne_session1`
    FOREIGN KEY (`id_session`)
    REFERENCES `db524752934`.`session` (`id_session`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_session_has_personne_personne1`
    FOREIGN KEY (`id_personne`)
    REFERENCES `db524752934`.`personne` (`id_personne`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_candidature_etat_candidature1`
    FOREIGN KEY (`id_etat_candidature`)
    REFERENCES `db524752934`.`etat_candidature` (`id_etat_candidature`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB $$


-- -----------------------------------------------------
-- Table `db524752934`.`salle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db524752934`.`salle` (
  `id_salle` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_salle`),
  UNIQUE INDEX `nom_UNIQUE` (`nom` ASC))
ENGINE = InnoDB $$


-- -----------------------------------------------------
-- Table `db524752934`.`seance`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db524752934`.`seance` (
  `id_module` INT NOT NULL,
  `id_session` INT NOT NULL,
  `id_formateur` INT NOT NULL,
  `id_salle` INT NOT NULL,
  `debut` DATETIME NOT NULL,
  `fin` DATETIME NOT NULL,
  `contenu` TEXT NULL,
  PRIMARY KEY (`id_module`, `id_session`, `id_formateur`, `id_salle`, `debut`, `fin`),
  INDEX `fk_seance_session1_idx` (`id_session` ASC),
  INDEX `fk_seance_formateur1_idx` (`id_formateur` ASC),
  INDEX `fk_seance_salle1_idx` (`id_salle` ASC),
  INDEX `fk_seance_module1` (`id_module` ASC),
  CONSTRAINT `fk_seance_module1`
    FOREIGN KEY (`id_module`)
    REFERENCES `db524752934`.`module` (`id_module`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_seance_session1`
    FOREIGN KEY (`id_session`)
    REFERENCES `db524752934`.`session` (`id_session`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_seance_formateur1`
    FOREIGN KEY (`id_formateur`)
    REFERENCES `db524752934`.`formateur` (`id_formateur`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_seance_salle1`
    FOREIGN KEY (`id_salle`)
    REFERENCES `db524752934`.`salle` (`id_salle`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB $$


-- -----------------------------------------------------
-- Table `db524752934`.`note`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db524752934`.`note` (
  `id_evaluation` INT NOT NULL,
  `id_stagiaire` INT NOT NULL,
  `note` DECIMAL(3,1) NOT NULL,
  PRIMARY KEY (`id_evaluation`, `id_stagiaire`),
  INDEX `fk_note_personne1_idx` (`id_stagiaire` ASC),
  CONSTRAINT `fk_note_evaluation1`
    FOREIGN KEY (`id_evaluation`)
    REFERENCES `db524752934`.`evaluation` (`id_evaluation`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_note_personne1`
    FOREIGN KEY (`id_stagiaire`)
    REFERENCES `db524752934`.`personne` (`id_personne`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB $$


-- -----------------------------------------------------
-- Table `db524752934`.`theme`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db524752934`.`theme` (
  `id_theme` INT NOT NULL AUTO_INCREMENT,
  `libelle` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_theme`),
  UNIQUE INDEX `libelle_UNIQUE` (`libelle` ASC))
ENGINE = InnoDB $$


-- -----------------------------------------------------
-- Table `db524752934`.`module_theme`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db524752934`.`module_theme` (
  `id_module` INT NOT NULL,
  `id_theme` INT NOT NULL,
  PRIMARY KEY (`id_module`, `id_theme`),
  INDEX `fk_module_has_theme_theme1_idx` (`id_theme` ASC),
  INDEX `fk_module_has_theme_module1_idx` (`id_module` ASC),
  CONSTRAINT `fk_module_has_theme_module1`
    FOREIGN KEY (`id_module`)
    REFERENCES `db524752934`.`module` (`id_module`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_module_has_theme_theme1`
    FOREIGN KEY (`id_theme`)
    REFERENCES `db524752934`.`theme` (`id_theme`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB $$


-- -----------------------------------------------------
-- Table `db524752934`.`bilan`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db524752934`.`bilan` (
  `id_bilan` INT NOT NULL AUTO_INCREMENT,
  `id_session` INT NOT NULL,
  `date_effet` DATE NOT NULL,
  PRIMARY KEY (`id_bilan`),
  UNIQUE INDEX `id_UNIQUE` (`id_bilan` ASC),
  INDEX `session1_idx` (`id_session` ASC),
  CONSTRAINT `session1`
    FOREIGN KEY (`id_session`)
    REFERENCES `db524752934`.`session` (`id_session`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB $$


-- -----------------------------------------------------
-- Table `db524752934`.`bulletin`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db524752934`.`bulletin` (
  `id_stagiaire` INT NOT NULL,
  `id_bilan` INT NOT NULL,
  `commentaire` VARCHAR(250) NULL,
  INDEX `personne1_idx` (`id_stagiaire` ASC),
  INDEX `bilan1_idx` (`id_bilan` ASC),
  PRIMARY KEY (`id_stagiaire`, `id_bilan`),
  CONSTRAINT `personne1`
    FOREIGN KEY (`id_stagiaire`)
    REFERENCES `db524752934`.`personne` (`id_personne`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `bilan1`
    FOREIGN KEY (`id_bilan`)
    REFERENCES `db524752934`.`bilan` (`id_bilan`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB $$


-- -----------------------------------------------------
-- Table `db524752934`.`ligne_bulletin`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db524752934`.`ligne_bulletin` (
  `id_module` INT NOT NULL,
  `id_formateur` INT NOT NULL,
  `id_stagiaire` INT NOT NULL,
  `id_bilan` INT NOT NULL,
  `commentaire` VARCHAR(250) NULL,
  PRIMARY KEY (`id_module`, `id_formateur`, `id_stagiaire`, `id_bilan`),
  INDEX `module1_idx` (`id_module` ASC),
  INDEX `formateur1_idx` (`id_formateur` ASC),
  INDEX `personne2_idx` (`id_stagiaire` ASC),
  INDEX `bilan2_idx` (`id_bilan` ASC),
  CONSTRAINT `module1`
    FOREIGN KEY (`id_module`)
    REFERENCES `db524752934`.`module` (`id_module`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `formateur1`
    FOREIGN KEY (`id_formateur`)
    REFERENCES `db524752934`.`formateur` (`id_formateur`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `personne2`
    FOREIGN KEY (`id_stagiaire`)
    REFERENCES `db524752934`.`personne` (`id_personne`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `bilan2`
    FOREIGN KEY (`id_bilan`)
    REFERENCES `db524752934`.`bilan` (`id_bilan`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB $$


-- -----------------------------------------------------
-- Table `db524752934`.`intervenant`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db524752934`.`intervenant` (
  `id_module` INT NOT NULL,
  `id_session` INT NOT NULL,
  `id_formateur` INT NOT NULL,
  PRIMARY KEY (`id_module`, `id_session`, `id_formateur`),
  INDEX `session2_idx` (`id_session` ASC),
  INDEX `module2_idx` (`id_module` ASC),
  INDEX `formateur2_idx` (`id_formateur` ASC),
  CONSTRAINT `module2`
    FOREIGN KEY (`id_module`)
    REFERENCES `db524752934`.`module` (`id_module`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `session2`
    FOREIGN KEY (`id_session`)
    REFERENCES `db524752934`.`session` (`id_session`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `formateur2`
    FOREIGN KEY (`id_formateur`)
    REFERENCES `db524752934`.`formateur` (`id_formateur`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB $$


-- Remettre les contraintes d'intégrité
SET FOREIGN_KEY_CHECKS=1 $$
/*-------------------------------- Vues ------------*/

DROP VIEW IF EXISTS stagiaire $$
CREATE VIEW stagiaire AS
    SELECT
        p.id_personne AS id_stagiaire,
        civilite,
        prenom,
        nom,
        date_naissance,
        adresse,
        code_postal,
        ville,
        telephone,
        telephone2,
        email,
        mot_passe,
        date_inscription,
        id_session,
        date_effet AS date_candidature,
        motivation
    FROM candidature c
		INNER JOIN personne p
			ON p.id_personne = c.id_personne
    WHERE id_etat_candidature = 5 $$

DROP VIEW IF EXISTS bulletin_note $$

CREATE VIEW bulletin_note AS

	SELECT formation.nom AS diplome,
			YEAR(session.date_fin) AS annee,
			stagiaire.id_stagiaire,
			stagiaire.prenom AS prenom_stagiaire,
			stagiaire.nom AS nom_stagiaire,
			stagiaire.date_naissance,
			stagiaire.id_session,
			module.id_module,
			module.nom AS matiere,
			formateur.id_formateur,
			personne.prenom AS prenom_formateur,
			personne.nom AS nom_formateur,
			AVG(note.note) AS moyenne,
			ligne_bulletin.commentaire AS avis_prof,
			bulletin.commentaire AS avis_proviseur,
            bilan.id_bilan,
            bilan.date_effet AS date_bilan
	FROM ligne_bulletin
		INNER JOIN module
			ON ligne_bulletin.id_module = module.id_module
		INNER JOIN stagiaire
			ON ligne_bulletin.id_stagiaire = stagiaire.id_stagiaire
		INNER JOIN formateur
			ON ligne_bulletin.id_formateur = formateur.id_formateur
		INNER JOIN bilan
			ON ligne_bulletin.id_bilan = bilan.id_bilan
		INNER JOIN personne
			ON formateur.id_formateur = personne.id_personne
		INNER JOIN bulletin
			ON bilan.id_bilan = bulletin.id_bilan
			AND stagiaire.id_stagiaire = bulletin.id_stagiaire
		INNER JOIN module_formation
			ON module.id_module = module_formation.id_module
		INNER JOIN formation
			ON module_formation.id_formation = formation.id_formation
		INNER JOIN evaluation
			ON module.id_module = evaluation.id_module
			AND formateur.id_formateur = evaluation.id_formateur
			AND stagiaire.id_session = evaluation.id_session
		INNER JOIN note
			ON evaluation.id_evaluation = note.id_evaluation
			AND stagiaire.id_stagiaire = note.id_stagiaire
		INNER JOIN session
			ON stagiaire.id_session = session.id_session
		WHERE evaluation.date_effet <= bilan.date_effet
			AND evaluation.date_effet > IFNULL((SELECT MAX(b2.date_effet) FROM bilan b2 WHERE b2.id_session = stagiaire.id_session AND b2.date_effet < bilan.date_effet), '1900-01-01')
	GROUP BY formation.nom,
			YEAR(session.date_fin),
			stagiaire.id_stagiaire,
			stagiaire.prenom,
			stagiaire.nom,
			stagiaire.date_naissance,
			stagiaire.id_session,
			module.id_module,
			module.nom,
			formateur.id_formateur,
			personne.prenom,
			personne.nom,
			ligne_bulletin.commentaire,
			bulletin.commentaire,
            bilan.id_bilan,
            bilan.date_effet $$

/*------------------------ Fonctions -------- */
DROP FUNCTION IF EXISTS initcap $$
CREATE FUNCTION initcap(chaine text) RETURNS text CHARSET utf8 deterministic
BEGIN
    DECLARE gauche, droite text;
    SET gauche='';
    SET droite ='';
    WHILE chaine LIKE '% %' DO -- si elle contient un espace
        SELECT SUBSTRING_INDEX(chaine, ' ', 1) INTO gauche;
        SELECT SUBSTRING(chaine, LOCATE(' ', chaine) + 1) INTO chaine;
        SELECT CONCAT(droite, ' ',
            CONCAT(UPPER(SUBSTRING(gauche, 1, 1)),
            LOWER(SUBSTRING(gauche, 2)))) INTO droite;
    END WHILE;
    RETURN LTRIM(CONCAT(droite, ' ', CONCAT(UPPER(SUBSTRING(chaine,1,1)), LOWER(SUBSTRING(chaine, 2)))));
END$$



/*------------------------ Procédures -------- */
DROP PROCEDURE IF EXISTS refresh_base$$

CREATE  PROCEDURE refresh_base()
BEGIN
  -- Lever temporairement les contraintes d'intégrité
  SET FOREIGN_KEY_CHECKS=0;
  -- Vider les tables sans log, en reinitialisant leur auto-increment à 1
  TRUNCATE TABLE bilan;
  TRUNCATE TABLE bulletin;
  TRUNCATE TABLE candidature;
  TRUNCATE TABLE etat_candidature;
  TRUNCATE TABLE evaluation;
  TRUNCATE TABLE formateur;
  TRUNCATE TABLE formation;
  TRUNCATE TABLE ligne_bulletin;
  TRUNCATE TABLE module;
  TRUNCATE TABLE module_formation;
  TRUNCATE TABLE module_theme;
  TRUNCATE TABLE note;
  TRUNCATE TABLE personne;
  TRUNCATE TABLE salle;
  TRUNCATE TABLE seance;
  TRUNCATE TABLE session;
  TRUNCATE TABLE theme;
  -- Retablir les contraintes d'intégrité
  SET FOREIGN_KEY_CHECKS=1;


  START TRANSACTION;
  INSERT INTO personne
  (id_personne,civilite,prenom, nom,adresse,code_postal,ville,telephone,telephone2,email,mot_passe,date_inscription,est_inscrite) VALUES
  (1, 'M.', 'Joel', 'BANKA', '3 Rue du Gros Chêne', '92370', 'CHAVILLE', '0614787928', null, 'bankajoel@yahoo.fr', 'banka', '2014-06-02 09:00:00', 0),
  (2, 'Mle', 'Stephanie', 'BRIERRE', '40 Rue EXELMANS', '78140', 'VELIZY', '0662931606', null, 'stephanibrierRe@gmail.com', 'telephone', '2014-06-02 09:00:00', 0),
  (3, 'Mle', 'Marion', 'DESCIEUX', '60 Rue du General leclerc', '91470', 'FORGES LES BAINS', '0673422520', null, 'mariondescieux@yahoo.fr', 'bouboul', '2014-06-02 09:00:00', 0),
  (4, 'M.',  'Michel', 'PLASSE', '43 Rue Saint louis a lile', '75100', 'PARIS', '0651080681', null, 'michelplace@free.fr','internet','2014-06-02 09:00:00', 0),
  (5, 'M.',  'Pascal', 'SORIN', '43 Rue Saint louis a lile', '75100', 'PARIS', '0651080681', null, 'pascalsorin@gmail.com','reseau','2014-06-02 09:00:00', 0),
  (6, 'Mme', 'Catherine', 'HORCHANI', null, '91300', 'Massy', null, null, 'catfed@free.fr', 'anglais', '0000-00-00 00:00:00', 0),
  (7, 'M.', 'Boussad', 'AIT ALI BRAHAM', null, '91300',	'Massy', null,null, 'profadomicile@wanadoo.fr',	'maths', '0000-00-00 00:00:00',	0),
  (22, 'Mme', 'Blanche', 'COURTEAU', null, '91300', 'Massy', null, null, '1@bidon.com',	'francais', '0000-00-00 00:00:00', 0),
  (23, 'M.', 'Mathieu',	'RENOUF', null, '91300', 'Massy', null, null, '2@bidon.com', 'Eco', '0000-00-00 00:00:00', 0),
  (24, 'M.', 'Alexandre', 'MASSON', null, '91300', 'Massy', null, null, '3@bidon.com', 'Droit', '0000-00-00 00:00:00', 0),
  (25, 'M.', 'Jean', 'GAUTHIER', null, '91300',	'Massy', null, null, '4@bidon.com', 'SISR', '0000-00-00 00:00:00', 0),
  (26, 'Mme', 'Fatma', 'HAMOUDA', null, '91300', 'Massy', null, null, '5@bidon.com', 'SLAM', '0000-00-00 00:00:00', 0),
  (27, 'M.', 'Salim', 'HAMIDOU', null, '91300', 'Massy', null, null, '6@bidon.com', 'SLAM', '0000-00-00 00:00:00', 0),
  (28, 'M.', 'Jean-françois', 'POIVEY', null, '91300', 'Massy', null, null, '7@bidon.com', 'SLAM', '0000-00-00 00:00:00', 0);

  INSERT INTO formateur
  (id_formateur) VALUES
  (4),
  (5),
  (6),
  (7),
  (22),
  (23),
  (24),
  (25),
  (26),
  (27),
  (28);

  INSERT INTO module
  (id_module, nom, objectif, contenu, nb_heures, prerequis) VALUES
  (1, 'SI2', 'Enseigner aux élèves les bases sur le fonctionnement du réseau internet', 'Des TP et des cours', 30, 'Les prérequis sont le module SI1 et le binaire'),
  (2, 'Maths', 'Enseigner aux élèves les notions de mathématiques nécessaires en informatique', 'Des cours théoriques et du python', 50, 'Les prérequis sont le BAC'),
  (3, 'Anglais', 'Enseigner la compréhension orale et de texte', 'Des cours et beaucoup de pratique orale', 50, 'Les prérequis sont le BAC et un peu d''attention'),
  (4, 'Montage video', 'Maîtriser le montage de vidéo (postproduction)', 'Principes du montage, logiciels, pratique en mode projet', 50, 'savoir utiliser windows'),
  (10, 'Culture générale', null, null, null, null),
  (11, 'Economie-droit', null, null, null, null),
  (12, 'Algorithmique', null, null, null, null),
  (13, 'SLAM', null, null, null, null),
  (14, 'SISR', null, null, null, null);

   INSERT INTO formation
  (id_formation, nom, description) VALUES
  (1, 'BTS SIO', 'BTS Services Informatiques aux Organisations options SISR ou SLAM'),
  (2, 'BTS CG', 'BTS Comptabilité et Gestion'),
  (3, 'BTS Audiovisuel', 'BTS Audiovisuel option Son, Image ou Montage');

  INSERT INTO module_formation
  (id_module, id_formation) VALUES
  (1, 1),
  (2, 1),
  (3, 1),
  (10, 1),
  (11, 1),
  (12, 1),
  (13, 1),
  (14, 1);

  INSERT INTO session
  (id_session, nom, date_debut, date_fin, description, id_formation, date_debut_inscription, date_fin_inscription) VALUES
  (1, 'BTS SIO 2015', '2014-06-02', '2015-05-07', '3ème session pour le BTS SIO', 1, '2014-03-07 09:00:00', '2014-04-07 18:00:00'),
  (2, 'BTS CG 2016', '2015-09-25', '2016-09-15', '2ème session pour le BTS CG', 2, '2015-07-25 09:00:00', '2015-08-25 18:00:00'),
  (3, 'BTS Audio 2016', '2015-11-15', '2016-11-05', '1ère session pour le BTS Audiovisuel option son', 2, '2015-09-15 09:00:00', '2015-10-25 18:00:00');

  INSERT INTO evaluation
  (id_evaluation, id_module, id_session, id_formateur, date_effet) VALUES
  (25, 2, 1, 7, '2015-01-01'),
  (31, 2, 1, 7, '2015-03-04'),
  (41, 2, 1, 7, '2014-08-01'),
  (42, 2, 1, 7, '2014-11-01'),
  (26, 3, 1, 6, '2015-01-01'),
  (32, 3, 1, 6, '2015-03-04'),
  (43, 3, 1, 6, '2014-08-01'),
  (44, 3, 1, 6, '2014-11-01'),
  (27, 10, 1, 22, '2015-01-01'),
  (33, 10, 1, 22, '2015-03-04'),
  (45, 10, 1, 22, '2014-08-01'),
  (46, 10, 1, 22, '2014-11-01'),
  (28, 11, 1, 23, '2015-01-01'),
  (34, 11, 1, 23, '2015-03-04'),
  (37, 11, 1, 24, '2015-01-01'),
  (38, 11, 1, 24, '2015-03-04'),
  (47, 11, 1, 23, '2014-08-01'),
  (48, 11, 1, 23, '2014-11-01'),
  (49, 11, 1, 24, '2014-08-01'),
  (50, 11, 1, 24, '2014-11-01'),
  (29, 12, 1, 7, '2015-01-01'),
  (35, 12, 1, 7, '2015-03-04'),
  (51, 12, 1, 7, '2014-08-01'),
  (52, 12, 1, 7, '2014-11-01'),
  (30, 13, 1, 4, '2015-01-01'),
  (36, 13, 1, 4, '2015-03-04'),
  (39, 13, 1, 26, '2015-01-01'),
  (40, 13, 1, 26, '2015-03-04'),
  (53, 13, 1, 4, '2014-08-01'),
  (54, 13, 1, 4, '2014-11-01'),
  (55, 13, 1, 26, '2014-08-01'),
  (56, 13, 1, 26, '2014-11-01');

  INSERT INTO note
  (id_evaluation, id_stagiaire, note) VALUES
  (56, 1, 10.0),
  (56, 2, 11.0),
  (56, 3, 12.0),
  (55, 1, 7.0),
  (55, 2, 8.0),
  (55, 3, 9.0),
  (54, 1, 4.0),
  (54, 2, 5.0),
  (54, 3, 6.0),
  (53, 1, 1.0),
  (53, 2, 2.0),
  (53, 3, 3.0),
  (52, 1, 18.0),
  (52, 2, 19.0),
  (52, 3, 20.0),
  (51, 1, 15.0),
  (51, 2, 16.0),
  (51, 3, 17.0),
  (50, 1, 12.0),
  (50, 2, 13.0),
  (50, 3, 14.0),
  (49, 1, 9.0),
  (49, 2, 10.0),
  (49, 3, 11.0),
  (48, 1, 6.0),
  (48, 2, 7.0),
  (48, 3, 8.0),
  (47, 1, 19.0),
  (47, 2, 20.0),
  (47, 3, 5.0),
  (46, 1, 16.0),
  (46, 2, 17.0),
  (46, 3, 18.0),
  (45, 1, 13.0),
  (45, 2, 14.0),
  (45, 3, 15.0),
  (44, 1, 10.0),
  (44, 2, 11.0),
  (44, 3, 12.0),
  (43, 1, 7.0),
  (43, 2, 8.0),
  (43, 3, 9.0),
  (42, 1, 4.0),
  (42, 2, 5.0),
  (42, 3, 6.0),
  (41, 1, 1.0),
  (41, 2, 2.0),
  (41, 3, 3.0),
  (40, 1, 6.0),
  (40, 2, 7.0),
  (40, 3, 8.0),
  (39, 1, 3.0),
  (39, 2, 4.0),
  (39, 3, 5.0),
  (38, 1, 20.0),
  (38, 2, 1.0),
  (38, 3, 2.0),
  (37, 1, 17.0),
  (37, 2, 18.0),
  (37, 3, 19.0),
  (36, 1, 14.0),
  (36, 2, 15.0),
  (36, 3, 16.0),
  (35, 1, 11.0),
  (35, 2, 12.0),
  (35, 3, 13.0),
  (34, 1, 8.0),
  (34, 2, 9.0),
  (34, 3, 10.0),
  (33, 1, 5.0),
  (33, 2, 6.0),
  (33, 3, 7.0),
  (32, 1, 2.0),
  (32, 2, 3.0),
  (32, 3, 4.0),
  (31, 1, 19.0),
  (31, 2, 20.0),
  (31, 3, 1.0),
  (30, 1, 16.0),
  (30, 2, 17.0),
  (30, 3, 18.0),
  (29, 1, 13.0),
  (29, 2, 14.0),
  (29, 3, 15.0),
  (28, 1, 10.0),
  (28, 2, 11.0),
  (28, 3, 12.0),
  (27, 1, 7.0),
  (27, 2, 8.0),
  (27, 3, 9.0),
  (26, 1, 4.0),
  (26, 2, 5.0),
  (26, 3, 6.0),
  (25, 1, 1.0),
  (25, 2, 2.0),
  (25, 3, 3.0);

  INSERT INTO etat_candidature
  (id_etat_candidature, libelle) VALUES
  (0, 'validée'),
  (1, 'en attente de traitement'),
  (2, 'refusée '),
  (3, 'convoqué'),
  (4, 'accepté'),
  (5, 'inscrit'),
  (6, 'désisté'),
  (7, 'liste d''attente');

  INSERT INTO candidature
  (id_session, id_personne, id_etat_candidature, date_effet, motivation) VALUES
  (1, 1, 5, '2014-06-02', 'no comment'),
  (1, 2, 5, '2014-06-02', 'no comment'),
  (1, 3, 5, '2014-06-02', 'no comment');

  INSERT INTO intervenant
  (id_module, id_session, id_formateur) VALUES
  (2, 1, 7),
  (3, 1, 6),
  (10, 1, 22),
  (11, 1, 23),
  (11, 1, 24),
  (12, 1, 7),
  (13, 1, 4),
  (13, 1, 26),
  (13, 1, 27),
  (13, 1, 28),
  (14, 1, 5),
  (14, 1, 25);

  INSERT INTO bilan
  (id_bilan, id_session, date_effet) VALUES
  (1, 1, '2014-11-14'),
  (2, 1, '2015-04-15');

  COMMIT;
END$$



/* Insère une note ou la met à jour */
DROP PROCEDURE IF EXISTS insert_update_note$$
CREATE PROCEDURE insert_update_note(p_id_evaluation INT, p_id_stagiaire INT, p_note DECIMAL(3,1))
 BEGIN
	DECLARE v_note DECIMAL(3,1);
    SELECT note INTO v_note
    FROM note
    WHERE id_evaluation = p_id_evaluation AND id_stagiaire = p_id_stagiaire;
    IF v_note IS NULL THEN
		-- inserer
        INSERT INTO note (id_evaluation, id_stagiaire, note)
        VALUES (p_id_evaluation, p_id_stagiaire, p_note);
	ELSE
		-- mettre a jour
        UPDATE note
        SET note = p_note
        WHERE id_evaluation = p_id_evaluation AND id_stagiaire = p_id_stagiaire;
	END IF;
END$$

/*--------------------- Declencheurs ------------*/

DROP TRIGGER IF EXISTS salle_before_update_trigger $$

CREATE TRIGGER salle_before_update_trigger
BEFORE UPDATE ON salle
FOR EACH ROW
BEGIN
	SET new.nom = TRIM(UPPER(new.nom));
	IF new.nom regexp '^ *$' THEN
    CALL raise_error();
-- 		signal sqlstate '45000'
--     set message_text = 'Nom vide', mysql_errno = 3000;
	END IF;
END$$



DROP TRIGGER IF EXISTS personne_before_update_trigger$$

CREATE TRIGGER personne_before_update_trigger
BEFORE UPDATE ON personne
FOR EACH ROW
BEGIN
	SET NEW.prenom = trim(initcap(NEW.prenom));
	IF NEW.prenom REGEXP '^ *$' THEN
    -- SIGNAL pas disponible sur le serveur de production (v5.1)
    -- => contourner en provoquant une erreur par l'appel à une
    -- procédure inexistante
    CALL raise_error();
-- 		SIGNAL SQLSTATE '45000'
-- 		SET MESSAGE_TEXT='Prénom vide', MYSQL_ERRNO=3000;
	END if;

    SET NEW.nom = trim(UPPER(NEW.nom));
    IF NEW.nom REGEXP '^ *$' THEN
    CALL raise_error();
-- 		SIGNAL SQLSTATE '45000'
-- 		SET MESSAGE_TEXT='Nom vide', MYSQL_ERRNO=3000;
	END if;

    SET NEW.adresse = trim(initcap(NEW.adresse));
    IF NEW.adresse REGEXP '^ *$' THEN
    CALL raise_error();
-- 		SIGNAL SQLSTATE '45000'
-- 		SET MESSAGE_TEXT='Adresse vide', MYSQL_ERRNO=3000;
	END if;

  SET NEW.ville = trim(initcap(NEW.ville));
	IF NEW.ville REGEXP '^ *$' THEN
    CALL raise_error();
-- 		SIGNAL SQLSTATE '45000'
-- 		SET MESSAGE_TEXT='Ville vide', MYSQL_ERRNO=3000;
	END if;

    SET NEW.telephone =  replace(replace(NEW.telephone, '.', ''), ' ', '');

END$$


DROP TRIGGER IF EXISTS personne_before_insert_trigger$$

CREATE TRIGGER personne_before_insert_trigger
BEFORE INSERT ON personne
FOR EACH ROW
BEGIN
	SET NEW.prenom = trim(initcap(NEW.prenom));
	IF NEW.prenom REGEXP '^ *$' THEN
    CALL raise_error();
-- 		SIGNAL SQLSTATE '45000'
-- 		SET MESSAGE_TEXT='Prénom vide', MYSQL_ERRNO=3000;
	END if;

  SET NEW.nom = trim(UPPER(NEW.nom));
  IF NEW.nom REGEXP '^ *$' THEN
    CALL raise_error();
-- 		SIGNAL SQLSTATE '45000'
-- 		SET MESSAGE_TEXT='Nom vide', MYSQL_ERRNO=3000;
	END if;

  SET NEW.adresse = trim(initcap(NEW.adresse));
  IF NEW.adresse REGEXP '^ *$' THEN
    CALL raise_error();
-- 		SIGNAL SQLSTATE '45000'
-- 		SET MESSAGE_TEXT='Adresse vide', MYSQL_ERRNO=3000;
	END if;

  Set NEW.ville = trim(initcap(NEW.ville));
	IF NEW.ville REGEXP '^ *$' THEN
    CALL raise_error();
-- 		SIGNAL SQLSTATE '45000'
-- 		SET MESSAGE_TEXT='Ville vide', MYSQL_ERRNO=3000;
	END if;

    SET NEW.telephone =  replace(replace(NEW.telephone, '.', ''), ' ', '');

END$$

DROP TRIGGER IF EXISTS bulletin_after_insert_trigger$$

CREATE TRIGGER bulletin_after_insert_trigger
AFTER INSERT ON bulletin
FOR EACH ROW
BEGIN
    DECLARE v_id_module INT;
    DECLARE v_id_formateur INT;
    DECLARE v_termine BOOLEAN DEFAULT FALSE;
    DECLARE v_lignes CURSOR FOR SELECT intervenant.id_module, intervenant.id_formateur
                                FROM bulletin
                                INNER JOIN bilan
                                    ON bulletin.id_bilan = bilan.id_bilan
                                INNER JOIN session
                                    ON bilan.id_session = session.id_session
                                INNER JOIN intervenant
                                    ON session.id_session = intervenant.id_session
                                WHERE bulletin.id_bilan = NEW.id_bilan
                                AND bulletin.id_stagiaire = NEW.id_stagiaire;
    OPEN v_lignes;
    BEGIN
	DECLARE EXIT HANDLER FOR NOT FOUND SET v_termine = TRUE;
        REPEAT
            FETCH v_lignes INTO v_id_module, v_id_formateur;
            INSERT INTO ligne_bulletin (id_module, id_formateur, id_stagiaire, id_bilan) VALUES (v_id_module, v_id_formateur, NEW.id_stagiaire, NEW.id_bilan);
            UNTIL v_termine END REPEAT;
    END;
    CLOSE v_lignes;
END$$

DROP TRIGGER IF EXISTS bilan_after_insert_trigger$$

CREATE TRIGGER bilan_after_insert_trigger
AFTER INSERT ON bilan
FOR EACH ROW
BEGIN
    DECLARE v_id_stagiaire INT;
    DECLARE v_termine BOOLEAN DEFAULT FALSE;
    DECLARE v_lignes CURSOR FOR SELECT id_stagiaire
                                FROM stagiaire
                                WHERE id_session = NEW.id_session;
    OPEN v_lignes;
    BEGIN
	DECLARE EXIT HANDLER FOR NOT FOUND SET v_termine = TRUE;
        REPEAT
            FETCH v_lignes INTO v_id_stagiaire;
            INSERT INTO bulletin (id_stagiaire, id_bilan) VALUES (v_id_stagiaire, NEW.id_bilan);
            UNTIL v_termine END REPEAT;
    END;
    CLOSE v_lignes;
END$$


/*-------------------- Initialiser les données ---------*/
CALL refresh_base()$$
