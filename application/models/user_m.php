<?php

class User_m extends CI_Model {

    private $email;

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /** Renvoie un utilisateur sous forme d'un 
     * array(id_personne, nom, prenom, email, is_formateur, is_stagiaire), 
     * ou null, si pas trouvé
     */
    public function getByEmailPassword($email, $pwd) {
        $result = null;
        $sql = "SELECT 
            p.id_personne, p.civilite, p.nom, p.prenom, p.email,
            (f.id_formateur IS NOT NULL) AS is_formateur,
            (COUNT(s.id_stagiaire) <> 0) AS is_stagiaire
            FROM personne p
            LEFT OUTER JOIN formateur f
                    ON p.id_personne = f.id_formateur
            LEFT OUTER JOIN stagiaire s
                    ON p.id_personne = s.id_stagiaire
            WHERE p.email=? AND p.mot_passe=?
            GROUP BY p.id_personne, p.nom, p.prenom, p.email;";
        $query = $this->db->query($sql, array($email, $pwd));
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
        }
        return $result;
    }

}
