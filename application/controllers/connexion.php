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
    if (User_m::getByEmailPassword($email, $mdp) != null) {
      //on peut démarrer notre session
      session_start();
      // on enregistre les paramètres comme variables de session ($email)
      $_SESSION['email'] = $email;
      $data["msgConnexion"] = "$email Connecté";
    } else {
      $data["msgConnexion"] = "Email ou mot de passe inconnu";
    }
    $this->load->view("welcome_message", $data);
  }

  /** Terminer la connexion */
  public function fin() {
    session_start();
    session_destroy();
    $data = array("msgConnexion" => "Vous avez été déconnecté");
    $this->load->view("welcome_message", $data);
  }

}
