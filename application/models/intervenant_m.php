<?php

class Intervenant_m extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function supprimer($id_session, $id_module, $id_formateur) {
        $sql = "DELETE FROM intervenant"
                . "WHERE id_formateur = $id_formateur"
                . "AND id_module = $id_module"
                . "AND id_session = $id_session";
    }

    public function ajouter($id_session, $id_module, $id_formateur) {
        $sql = "INSERT INTO intervenant (id_module, id_session, id_formateur)"
                . "VALUES ($id_module, $id_session, $id_formateur)";
    }

}
