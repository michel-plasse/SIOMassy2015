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
-- Table personne
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS personne (
  id_personne INT NOT NULL AUTO_INCREMENT,
  civilite VARCHAR(3) NOT NULL,
  prenom VARCHAR(20) NOT NULL,
  nom VARCHAR(30) NOT NULL,
  adresse VARCHAR(45) NULL,
  code_postal VARCHAR(5) NULL,
  ville VARCHAR(30) NULL,
  telephone VARCHAR(15) NULL,
  telephone2 VARCHAR(15) NULL,
  email VARCHAR(30) NOT NULL,
  mot_passe VARCHAR(45) NOT NULL,
  date_inscription DATETIME NOT NULL COMMENT 'Date où la personne s\'est inscrite (avant la validation)',
  est_inscrite TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'Vrai quand l\'inscription est valdée',
  PRIMARY KEY (id_personne),
  UNIQUE INDEX email_UNIQUE (email ASC))
ENGINE = InnoDB$$


CREATE TABLE IF NOT EXISTS module (
  id_module INT NOT NULL AUTO_INCREMENT,
  nom VARCHAR(128) NOT NULL,
  objectif VARCHAR(512) NULL,
  contenu VARCHAR(45) NULL,
  nb_heures INT NULL,
  prerequis VARCHAR(512) NULL,
  PRIMARY KEY (id_module))
ENGINE = InnoDB$$


CREATE TABLE IF NOT EXISTS formation (
  id_formation INT NOT NULL AUTO_INCREMENT,
  nom VARCHAR(45) NOT NULL,
  description TEXT NULL,
  PRIMARY KEY (id_formation))
ENGINE = InnoDB$$


CREATE TABLE IF NOT EXISTS session (
  id_session INT NOT NULL AUTO_INCREMENT,
  nom VARCHAR(45) NOT NULL,
  date_debut DATE NOT NULL,
  date_fin DATE NOT NULL,
  description TEXT NULL,
  id_formation INT NOT NULL,
  date_debut_inscription DATETIME NULL,
  date_fin_inscription DATETIME NULL,
  PRIMARY KEY (id_session),
  INDEX fk_session_formation_idx (id_formation ASC),
  CONSTRAINT fk_session_formation
    FOREIGN KEY (id_formation)
    REFERENCES formation (id_formation)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB$$


CREATE TABLE IF NOT EXISTS formateur (
  id_personne INT NOT NULL,
  PRIMARY KEY (id_personne),
  CONSTRAINT fk_formateur_personne1
    FOREIGN KEY (id_personne)
    REFERENCES personne (id_personne)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB$$


CREATE TABLE IF NOT EXISTS evaluation (
  id_evaluation INT NOT NULL AUTO_INCREMENT,
  id_module INT NOT NULL,
  id_session INT NOT NULL,
  id_formateur INT NOT NULL,
  date_effet DATE NOT NULL,
  PRIMARY KEY (id_evaluation),
  INDEX fk_evaluation_module1_idx (id_module ASC),
  INDEX fk_evaluation_session1_idx (id_session ASC),
  INDEX fk_evaluation_formateur1_idx (id_formateur ASC),
  CONSTRAINT fk_evaluation_module1
    FOREIGN KEY (id_module)
    REFERENCES module (id_module)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_evaluation_session1
    FOREIGN KEY (id_session)
    REFERENCES session (id_session)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_evaluation_formateur1
    FOREIGN KEY (id_formateur)
    REFERENCES formateur (id_personne)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB $$


CREATE TABLE IF NOT EXISTS bilan (
  id_bilan INT(11) NOT NULL AUTO_INCREMENT,
  date_effet DATE NOT NULL,
  id_session INT(11) NOT NULL,
  PRIMARY KEY (id_bilan),
  UNIQUE INDEX id_UNIQUE (id_bilan ASC),
  INDEX session1_idx (id_session ASC),
  CONSTRAINT session1
    FOREIGN KEY (id_session)
    REFERENCES session (id_session)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB$$


CREATE TABLE IF NOT EXISTS bulletin (
  id_bulletin INT(11) NOT NULL AUTO_INCREMENT,
  commentaire VARCHAR(250) NOT NULL,
  id_personne INT(11) NOT NULL,
  id_bilan INT(11) NOT NULL,
  PRIMARY KEY (id_bulletin),
  UNIQUE INDEX id_UNIQUE (id_bulletin ASC),
  INDEX personne1_idx (id_personne ASC),
  INDEX bilan1_idx (id_bilan ASC),
  CONSTRAINT personne1
    FOREIGN KEY (id_personne)
    REFERENCES personne (id_personne)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT bilan1
    FOREIGN KEY (id_bilan)
    REFERENCES bilan (id_bilan)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci$$


CREATE TABLE IF NOT EXISTS ligne_bulletin (
  id_bulletin INT(11) NOT NULL,
  id_module INT(11) NOT NULL,
  commentaire VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (id_bulletin, id_module),
  INDEX module1_idx (id_module ASC),
  INDEX bulletin1_idx (id_bulletin ASC),
  CONSTRAINT bulletin1
    FOREIGN KEY (id_bulletin)
    REFERENCES bulletin (id_bulletin)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT module1
    FOREIGN KEY (id_module)
    REFERENCES module (id_module)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB$$


CREATE TABLE IF NOT EXISTS module_formation (
  id_module INT NOT NULL,
  id_formation INT NOT NULL,
  PRIMARY KEY (id_module, id_formation),
  INDEX fk_module_has_formation_formation1_idx (id_formation ASC),
  INDEX fk_module_has_formation_module1_idx (id_module ASC),
  CONSTRAINT fk_module_has_formation_module1
    FOREIGN KEY (id_module)
    REFERENCES module (id_module)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_module_has_formation_formation1
    FOREIGN KEY (id_formation)
    REFERENCES formation (id_formation)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB$$


CREATE TABLE IF NOT EXISTS etat_candidature (
  id_etat_candidature CHAR(1) NOT NULL,
  libelle VARCHAR(45) NOT NULL,
  PRIMARY KEY (id_etat_candidature))
ENGINE = InnoDB$$


CREATE TABLE IF NOT EXISTS candidature (
  id_session INT NOT NULL,
  id_personne INT NOT NULL,
  id_etat_candidature CHAR(1) NOT NULL,
  date_effet DATETIME NOT NULL,
  motivation TEXT NULL,
  PRIMARY KEY (id_session, id_personne),
  INDEX fk_session_has_personne_personne1_idx (id_personne ASC),
  INDEX fk_session_has_personne_session1_idx (id_session ASC),
  INDEX fk_candidature_etat_candidature1_idx (id_etat_candidature ASC),
  CONSTRAINT fk_session_has_personne_session1
    FOREIGN KEY (id_session)
    REFERENCES session (id_session)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_session_has_personne_personne1
    FOREIGN KEY (id_personne)
    REFERENCES personne (id_personne)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_candidature_etat_candidature1
    FOREIGN KEY (id_etat_candidature)
    REFERENCES etat_candidature (id_etat_candidature)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB$$


CREATE TABLE IF NOT EXISTS salle (
  id_salle INT NOT NULL AUTO_INCREMENT,
  nom VARCHAR(45) NOT NULL,
  PRIMARY KEY (id_salle),
  UNIQUE INDEX nom_UNIQUE (nom ASC))
ENGINE = InnoDB$$


CREATE TABLE IF NOT EXISTS seance (
  id_module INT NOT NULL,
  id_session INT NOT NULL,
  id_formateur INT(11) NOT NULL,
  debut DATETIME NOT NULL,
  fin DATETIME NOT NULL,
  id_salle INT NOT NULL,
  contenu TEXT NULL,
  PRIMARY KEY (id_session, debut, fin, id_salle, id_formateur, id_module),
  INDEX fk_seance_session1_idx (id_session ASC),
  INDEX fk_seance_formateur1_idx (id_formateur ASC),
  INDEX fk_seance_salle1_idx (id_salle ASC),
  CONSTRAINT fk_seance_module1
    FOREIGN KEY (id_module)
    REFERENCES module (id_module)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_seance_session1
    FOREIGN KEY (id_session)
    REFERENCES session (id_session)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_seance_formateur1
    FOREIGN KEY (id_formateur)
    REFERENCES formateur (id_personne)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_seance_salle1
    FOREIGN KEY (id_salle)
    REFERENCES salle (id_salle)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB$$


CREATE TABLE IF NOT EXISTS note (
  id_evaluation INT NOT NULL,
  id_personne INT NOT NULL,
  note DECIMAL(3,1) NOT NULL,
  PRIMARY KEY (id_evaluation, id_personne),
  INDEX fk_note_personne1_idx (id_personne ASC),
  CONSTRAINT fk_note_evaluation1
    FOREIGN KEY (id_evaluation)
    REFERENCES evaluation (id_evaluation)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_note_personne1
    FOREIGN KEY (id_personne)
    REFERENCES personne (id_personne)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB$$


CREATE TABLE IF NOT EXISTS theme (
  id_theme INT NOT NULL AUTO_INCREMENT,
  libelle VARCHAR(45) NOT NULL,
  PRIMARY KEY (id_theme),
  UNIQUE INDEX libelle_UNIQUE (libelle ASC))
ENGINE = InnoDB$$


CREATE TABLE IF NOT EXISTS module_theme (
  id_module INT NOT NULL,
  id_theme INT NOT NULL,
  PRIMARY KEY (id_module, id_theme),
  INDEX fk_module_has_theme_theme1_idx (id_theme ASC),
  INDEX fk_module_has_theme_module1_idx (id_module ASC),
  CONSTRAINT fk_module_has_theme_module1
    FOREIGN KEY (id_module)
    REFERENCES module (id_module)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_module_has_theme_theme1
    FOREIGN KEY (id_theme)
    REFERENCES theme (id_theme)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB$$



-- Remettre les contraintes d'intégrité
SET FOREIGN_KEY_CHECKS=1 $$
/*-------------------------------- Vues ------------*/

DROP VIEW IF EXISTS stagiaire $$
CREATE VIEW stagiaire AS
    SELECT
        p.id_personne AS id_personne,
        civilite,
        prenom,
        nom,
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
    FROM
        candidature c
            INNER JOIN
        personne p ON p.id_personne = c.id_personne
    WHERE
        id_etat_candidature = 5 $$



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
  (5, 'M.',  'Pascal', 'SORIN', '43 Rue Saint louis a lile', '75100', 'PARIS', '0651080681', null, 'pascalsorin@gmail.com','reseau','2014-06-02 09:00:00', 0);

  INSERT INTO formateur
  (id_personne) VALUES
  (4),
  (5);

  INSERT INTO module
  (id_module, nom, objectif, contenu, nb_heures, prerequis) VALUES
  (1, 'SI2', 'Enseigner aux élèves les bases sur le fonctionnement du réseau internet', 'Des TP et des cours', 30, 'Les prérequis sont le module SI1 et le binaire'),
  (2, 'Maths', 'Enseigner aux élèves les notions de mathématiques nécessaires en informatique', 'Des cours théoriques et du python', 50, 'Les prérequis sont le BAC'),
  (3, 'Anglais', 'Enseigner la compréhension orale et de texte', 'Des cours et beaucoup de pratique orale', 50, 'Les prérequis sont le BAC et un peu d''attention'),
  (4, 'Montage video', 'Maîtriser le montage de vidéo (postproduction)', 'Principes du montage, logiciels, pratique en mode projet', 50, 'savoir utiliser windows');

   INSERT INTO formation
  (id_formation, nom, description) VALUES
  (1, 'BTS SIO', 'BTS Services Informatiques aux Organisations options SISR ou SLAM'),
  (2, 'BTS CG', 'BTS Comptabilité et Gestion'),
  (3, 'BTS Audiovisuel', 'BTS Audiovisuel option Son, Image ou Montage');

  INSERT INTO module_formation(id_module, id_formation) VALUES
  (1, 1),
  (2, 1),
  (3, 1),
  (3, 2),
  (3, 3),
  (4, 3);

  INSERT INTO session
  (id_session, nom, date_debut, date_fin, description, id_formation, date_debut_inscription, date_fin_inscription) VALUES
  (1, 'BTS SIO 2015', '2014-06-02', '2015-05-07', '3ème session pour le BTS SIO', 1, '2014-03-07 09:00:00', '2014-04-07 18:00:00'),
  (2, 'BTS CG 2016', '2015-09-25', '2016-09-15', '2ème session pour le BTS CG', 2, '2015-07-25 09:00:00', '2015-08-25 18:00:00'),
  (3, 'BTS Audio 2016', '2015-11-15', '2016-11-05', '1ère session pour le BTS Audiovisuel option son', 2, '2015-09-15 09:00:00', '2015-10-25 18:00:00');

  INSERT INTO bilan
  (id_bilan, date_effet, id_session) VALUES
  (1, '2014-11-04', '1'),
  (2, '2015-04-14', '1');

  INSERT INTO evaluation
  (id_evaluation, id_module, id_session, id_formateur, date_effet) VALUES
  (1, 1, 1, 5, '2014-11-01'),
  (2, 2, 2, 4, '2015-03-24');

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

  COMMIT;
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



/*-------------------- Initialiser les données ---------*/
CALL refresh_base()$$