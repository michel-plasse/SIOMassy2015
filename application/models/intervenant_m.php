<?php

class Intervenant_m extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function supprimer($id_session, $id_module, $id_formateur) {
        $sql = "DELETE FROM intervenant
                WHERE id_formateur = $id_formateur
                AND id_module = $id_module
                AND id_session = $id_session";
        $query = $this->db->query($sql);
        return $query;
    }

    public function ajouter($id_session, $id_module, $id_formateur) {
        $sql = "INSERT INTO intervenant (id_module, id_session, id_formateur)
                VALUES ($id_module, $id_session, $id_formateur)";
        $query = $this->db->query($sql);
        return $query;
    }

    /** Renvoie un tableau associatif id_module => array(id_formateur => prenom+nom) */
    public function getIntervenants($id_session) {
        $sql = "SELECT id_module, id_formateur, concat(p.prenom, ' ', p.nom) AS nom_formateur
                FROM personne p INNER JOIN intervenant i
                ON p.id_personne = i.id_formateur
                WHERE id_session = $id_session
                ORDER BY id_module ASC, p.nom ASC";
        $query = $this->db->query($sql);
        $result = array();
        $ancienIdModule = 0;
//        header("Content-type: text/plain");
        foreach($query->result_array()as $row){
            if($row["id_module"]!= $ancienIdModule){
                // Nouveau module => ajouter une entree au resultat
                $ancienIdModule = $row["id_module"];
                $result[$ancienIdModule] = array();
            }
//            echo "-----------------";
//            print_r($result);
            $result[$ancienIdModule][$row["id_formateur"]] = $row["nom_formateur"]; 
       }
        return $result;
    }

    
}
