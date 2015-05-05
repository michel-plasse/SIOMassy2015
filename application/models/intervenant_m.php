<?php

class Intervenant_m extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function supprimer($id_session, $id_module, $id_formateur) {
        $sql = "DELETE";
    }

    public function ajouter($id_session, $id_module, $id_formateur) {
        $sql = "INSERT INTO intervenant";
    }

}
