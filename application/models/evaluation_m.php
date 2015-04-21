<?php

class Evaluation_m extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /** Requete fournissant les données (en-têtes) d'évaluations */
    const SQL_EN_TETES = "SELECT e.id_evaluation, m.id_module, m.nom AS nom_module,
    e.date_effet, e.id_formateur, p.prenom AS prenom_formateur,
    p.nom AS nom_formateur
    FROM evaluation e INNER JOIN module m
    ON e.id_module = m.id_module
    INNER JOIN personne p
    ON e.id_formateur = p.id_personne";

    /** Evaluations de la session $idSession.
     * Renvoie un tableau de tableaux associatifs
     * (id_evaluation, id_module, nom_module, date_effet,
     * id_formateur, prenom_formateur, nom_formateur).
     * Tableau vide si aucune évaluation trouvée.
     */
    public function getBySession($idSession) {
        $sql = Evaluation_m::SQL_EN_TETES;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /** Evaluation de id $idEval */
    public function getById($idEval) {
        $sql = Evaluation_m::SQL_EN_TETES . " WHERE id_evaluation = $idEval";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    /** Notes de l'évaluation de id $idEval.
     *  Fournit id_stagiaire, prenom, nom, note.
     */
    public function getNotesByIdEval($idEval) {
        $sql = "SELECT s.id_stagiaire AS id_stagiaire, s.prenom, s.nom, n.note
      FROM stagiaire s LEFT OUTER JOIN
      (
        SELECT id_stagiaire, note
        FROM note n INNER JOIN evaluation e
        ON n.id_evaluation = e.id_evaluation
        WHERE e.id_evaluation = $idEval
      ) n
       ON s.id_stagiaire = n.id_stagiaire
       WHERE s.id_session =
       (
        SELECT id_session
          FROM evaluation
          WHERE id_evaluation = $idEval
      )";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    /** Met a jour la note du stagiaire dans l'évaluation indiquée, ou
     * l'insère s'il n'y en a pas
     * 
     */
    public function updateNote($id_stagiaire, $id_evaluation, $note) {
        
        $sql = "CALL insert_update_note($id_evaluation, $id_stagiaire, $note)";
        $query = $this->db->query($sql);
        return $query;
    }
    public function getNotesByStagiaire($idStagiaire){
        $sql = "SELECT id_stagiaire, m.nom AS nom_module, e.date_effet, n.note
            FROM evaluation e 
            INNER JOIN module m ON e.id_module = m.id_module
                INNER JOIN personne p
                ON e.id_formateur = p.id_personne
                INNER JOIN note n
                ON n.id_evaluation = e.id_evaluation AND id_stagiaire = n.id_stagiaire
            WHERE id_stagiaire= $idStagiaire    ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}
