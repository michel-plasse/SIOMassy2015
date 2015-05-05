<?php

class Connexion extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_m');
        $this->load->helper('url');
    }

    /** Tente de connecter */
    public function index() {
        $email = $this->input->post('email');
        $mdp = $this->input->post('mdp');
        $data = array();
        $user = $this->user_m->getByEmailPassword($email, $mdp);
        $data["cssUrl"] = base_url("items/css/allproject.css");
        if ($user != null) {
            //on peut démarrer notre session
            session_start();
            // on enregistre les paramètres comme variables de session ($email)
            $_SESSION['user'] = $user;
            $data["msgConnexion"] = "$email Connecté";
        } else {
            $data["msgConnexion"] = "Email ou mot de passe inconnu";
        }
        $this->load->view("welcome_v", $data);
    }

    /** Terminer la connexion */
    public function fin() {
        session_start();
        session_unset();
        session_destroy();
        session_write_close();
        $data = array("msgConnexion" => "Vous avez été déconnecté");
        $data["cssUrl"] = base_url("items/css/allproject.css");
        $this->load->view("welcome_v", $data);
    }

    /** Fournit le id du stagiaire, selon son login/pwd pour se connecter en mobile */
    function getIdStagiaire() {
        header("Content-type: text/plain; charset=UTF-8");
        $email = $this->input->post('email');
        $pwd = $this->input->post('pwd');
        $user = $this->user_m->getByEmailPassword($email, $pwd);
        $result = ($user != null) ? $user["id_personne"] : "";
        print $result;
    }

    /** Rend le nom du stagiaire */
    function getNomStagiaire() {
        header("Content-type: text/plain; charset=UTF-8");
        $email = $this->input->post('email');
        $pwd = $this->input->post('pwd');
        $user = $this->user_m->getByEmailPassword($email, $pwd);
        $result = "";
        if ($user != null) {
            $result = "$user[civilite] $user[prenom] $user[nom]";
        }
        print $result;
    }

}
