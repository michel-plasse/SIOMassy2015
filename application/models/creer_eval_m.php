<?php

class Menus_m extends CI_Model {
    
    /** Charge le module database de CI */
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function InsertEval($data) {
        $db = DB::getConnection();
        $sql = "INSERT INTO evaluation (id_module, id_session, id_formateur, date_effet)
                VALUES (:id_session, :id_module, :id_formateur, :date_effet)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":id_session", $data["id_session"]);
        $query = $this->db->query($sql);
        return $query;
    }
}