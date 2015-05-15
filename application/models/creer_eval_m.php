<?php

require_once 'db.php';

class Creer_eval_m extends CI_Model {

    /** Charge le module database de CI */
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert($data) {
        $db = DB::getConnection();
        $sql = "INSERT INTO evaluation (id_module, id_session, id_formateur, date_effet)
                VALUES (:id_module, :id_session, :id_formateur, :date_effet)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":id_session", $data["idSession"]);
        $stmt->bindParam(":id_module", $data["idModule"]);
        $stmt->bindParam(":id_formateur", $data["idFormateur"]);
        $stmt->bindParam(":date_effet", $data["dateevaluation"]);
        $ok = $stmt->execute();
        if ($ok == FALSE) {
            $error = $db->errorInfo();
            throw new Exception($error[0], $error[1]);
        }
    }

}
