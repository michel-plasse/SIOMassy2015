<?php

require_once 'DB.php';

class Bilan_m extends CI_Model {

  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

  /** Insere un bilan. $data est un tableau associatif de clés date et id_session.
   * Lance une exception en cas de problème.
   */
  public function insert($data) {
    $db = DB::getConnection();
    $sql = "INSERT INTO bilan (id_bilan, date, id_session)
            VALUES (null, :date, :id_session)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":date", $data["date"]);
    $stmt->bindParam(":id_session", $data["id_session"]);
    $ok = $stmt->execute();
    if ($ok == FALSE) {
      $error = $db->errorInfo();
      throw new Exception($error[2], $error[1]);
    }
  }

  public function get($idBilan) {
    return $idBilan;
  }
}
