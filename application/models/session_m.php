<?php

class Session_m extends CI_Model{

    public function __construct() {
        parent::__construct();
    }
     public function supprimer($id_session, $id_module, $id_formateur) {
        
    }
    
    public function ajouter($id_session, $id_module, $id_formateur) {
        
    }
    
    public function getBySessionModule($id_session, $id_module) {
        return array(array(id_formateur, prenom, nom));
        
    }

}