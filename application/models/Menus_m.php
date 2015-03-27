<?php

/**
 * Modele fournissant les données pour des listes déroulantes
 */
class Menus_m extends CI_Model {

  /** Charge le module database de CI */
  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

  /** Fonction de base fournissant une liste de données
   * sous forme d'un tableau associatif value => text
   * (ex : (1 => "BTS SIO", 2 => "BTS IRIS")
   */
  protected function getMap($sql) {
    $query = $this->db->query($sql);
    $rows = $query->result_array();
    $result = array();
    foreach ($rows as $row) {
      $result[$row["value"]] = $row["text"];
    }
    return $result;
  }

  /** Sessions en cours sous forme d'un tableau associatif value => nom.
   * PAS TERMINE : prend toutes les sessions !
   */
  public function getSessionsEnCours() {
    $sql = "SELECT id_session AS value, nom AS text FROM session";
    return $this->getMap($sql);
  }

  /** Stagiaires de la session de id $idSession */
  public function getStagiaires($idSession) {
    $sql = "select id_personne AS value, concat(prenom, ' ', nom) AS text
                from stagiaire
                WHERE id_session = $idSession ";
    return $this->getMap($sql);
  }

  /** Modules de la session de id $id_session */
  public function getModules($idSession) {
    $sql = "SELECT id_module AS value, nom AS text
            FROM module WHERE id_module IN
            (
              SELECT id_module
              FROM module_formation
              WHERE id_formation IN
              (
                SELECT id_formation
                FROM session
                WHERE id_session=$idSession
              )
            )";
    return $this->getMap($sql);
  }

  /** Formateurs */
  public function getFormateurs() {
    $sql = "SELECT f.id_personne AS value, nom AS text
      FROM personne p INNER JOIN formateur f
      ON p.id_personne = f.id_personne";
    return $this->getMap($sql);
  }

}
