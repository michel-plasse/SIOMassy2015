<?php

class Intervenant_m extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function supprimer($id_session, $id_module, $id_formateur) {
        $sql = "";
    }

    public function ajouter($id_session, $id_module, $id_formateur) {
        $sql = "";
    }

    public function getBySessionModule($id_session, $id_module) {
        $sql = "select module.id_module, module.nom
                from intervenant inner join module
                on intervenant.id_module = module.id_module
                group by module.id_module;";
    }
}
