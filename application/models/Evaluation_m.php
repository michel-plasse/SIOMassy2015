<?php
class Evaluation_m extends CI_Model{
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
        
    }
    public function getSessions() {
        $result = array();
        $query = $this->db->query('SELECT id_session, nom FROM session ORDER BY nom ASC');
        foreach ($query->result_array() as $row) {
            $result[$row["id_session"]] = $row["nom"];
        }
        return $result;
    }
    
    public function getModules($id_session) {
        $result = array();
        $query = $this->db->query('SELECT id_module AS value, nom AS text FROM module');
        foreach ($query->result_array() as $row) {
            $result[$row["id_module"]] = $row["nom"];
        }
        return $result;
        
    }
    
    public function getFormateur() {
        $result = array();
        $query = $this->db->query('SELECT f.id_personne AS value, nom AS text FROM personne p INNER JOIN formateur f ON p.id_personne = f.id_personne');
        foreach ($query->result_array() as $row) {
            $result[$row["id_personne"]] = $row["nom"];
        }
        return $result;
        
    }
}   
    

