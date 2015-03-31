<?php

class Evaluation_m extends CI_Model {

  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

  /** Evaluations de la session $idSession.
   * Renvoie un tableau de tableaux associatifs
   * (id, id_module, nom_module, date,
   * id_formateur, prenom_formation, nom_formateur).
   * Tableau vide si aucune évaluation trouvée.
   */
  public function getBySession($idSession) {
    $sql = "SELECT id_evaluation, m.id_module, m.nom AS nom_module,
            date, ";
    $query = $this->db->query($sql);
    return $query->result_array();
  }

}
