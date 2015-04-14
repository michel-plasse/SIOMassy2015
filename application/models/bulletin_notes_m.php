<?php

class Bulletin_notes_m extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getInfosStagiaire($id_stagiaire) {
        $sql = "SELECT st.nom, st.prenom, st.date_naissance, f.nom AS nom_diplome, YEAR(s.date_fin) AS annee_diplome, f.id_formation
                FROM stagiaire st
                    INNER JOIN session s
                        ON st.id_session = s.id_session
                    INNER JOIN formation f
                        ON s.id_formation = f.id_formation
                WHERE st.id_personne = $id_stagiaire";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getInfosModule($id_formation, $id_personne) {
        $sql = "SELECT m.nom, ROUND(AVG(n.note), 1) AS moyenne
                FROM formation f
                    INNER JOIN module_formation mf
                        ON f.id_formation = mf.id_formation
                    INNER JOIN module m
                        ON mf.id_module = m.id_module
                    INNER JOIN evaluation e
                        ON m.id_module = e.id_module
                    INNER JOIN note n
                        ON e.id_evaluation = n.id_evaluation
                WHERE f.id_formation = $id_formation
                    AND n.id_personne = $id_personne
                GROUP BY m.nom";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getAll() {
        $sql = "SELECT s.id_session, s.nom AS nom_session, st.prenom AS prenom, st.nom AS nom, st.id_personne, s.id_formation
                FROM session s
                    INNER JOIN stagiaire st
                        ON s.id_session = st.id_session
                ORDER BY s.nom ASC, st.nom ASC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

}
