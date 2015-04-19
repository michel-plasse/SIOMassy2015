<?php

class Bulletin_notes_m extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getInfosStagiaire($id_session, $id_bilan, $id_stagiaire) {
        $sql = "SELECT bn2.moyenne_classe, bn2.min_classe, bn2.max_classe, bn1.diplome, bn1.annee, bn1.id_personne, bn1.prenom_stagiaire, bn1.nom_stagiaire, bn1.date_naissance, bn1.id_session, bn1.id_module, bn1.matiere,
			bn1.id_formateur, bn1.prenom_formateur, bn1.nom_formateur, Cast(bn1.moyenne as decimal(5,2)) as moyenne, bn1.avis_prof, bn1.avis_proviseur, bn1.id_bilan, bn1.date_bilan
                FROM bulletin_note bn1
                    INNER JOIN (
                            SELECT id_session,matiere, nom_formateur, id_bilan, Cast(Round(avg(moyenne),2) as decimal(5,2)) AS moyenne_classe, Cast(Round(min(moyenne),2) as decimal(5,2)) AS Min_classe, Cast(Round(max(moyenne),2) as decimal(5,2)) AS max_classe
                            FROM bulletin_note 
                            where id_bilan = $id_bilan
                            group by id_session, matiere, id_bilan, nom_formateur
                        )bn2
                        ON bn1.matiere = bn2.matiere
                        And bn1.nom_formateur = bn2.nom_formateur
                        And bn1.id_bilan = bn2.id_bilan
                        And bn1.id_session = bn2.id_session
                WHERE bn1.id_personne = $id_stagiaire
                AND bn1.id_bilan = $id_bilan
                AND bn1.id_session = $id_session
                ORDER BY bn1.matiere ASC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getMoyenneGlobale($id_session, $id_bilan, $id_stagiaire) {
        $sql = "SELECT (
                        SELECT Cast(Round(avg(moyenne),2) as decimal(5,2))
                        FROM bulletin_note
                        WHERE id_personne = $id_stagiaire
                        AND id_bilan = $id_bilan
                        AND id_session = $id_session
                        ) AS moyenne_stagiaire
                        ,(
                        SELECT Cast(Round(avg(moyenne),2) as decimal(5,2))
                        FROM bulletin_note
                        WHERE id_bilan = $id_bilan
                        AND id_session = $id_session
                        ) AS moyenne_classe";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getAll() {
        $sql = "SELECT s.id_session, s.nom AS nom_session, st.prenom AS prenom, st.nom AS nom, st.id_personne, s.id_formation, b.id_bilan, b.date_effet
                FROM session s
                    INNER JOIN stagiaire st
                        ON s.id_session = st.id_session
                    INNER JOIN bilan b
                            ON s.id_session = b.id_session
                ORDER BY s.nom ASC, b.date_effet, st.nom ASC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function updateBulletin($data) {
    $db = DB::getConnection();
    $sql = "UPDATE bulletin
            SET commentaire = :commentaire
            WHERE id_stagiaire = :id_stagiaire
            AND id_bilan = :id_bilan";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":commentaire", $data["commentaire"]);
    $stmt->bindParam(":id_stagiaire", $data["id_stagiaire"]);
    $stmt->bindParam(":id_bilan", $data["id_bilan"]);
    $ok = $stmt->execute();
    if ($ok == FALSE) {
      $error = $db->errorInfo();
      throw new Exception($error[0], $error[1]);
    }
  }
}
