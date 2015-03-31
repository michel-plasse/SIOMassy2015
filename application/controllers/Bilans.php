<?php

class Bilans extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('Menus_m');
    $this->load->model('Bilan_m');
  }

  public function index() {
//    $data["sessions"] = $this->Menus_m->getSessionsEnCours();
//    $data["bilans"] = $this->Menus_m->getBilansBySession($id_session);
//    $this->load->view('Bilans_v', $data);
    $this->session(1);
  }

  /** Bilans de la session de id $idSession */
  public function session($idSession) {
    $data["id_session"] = $idSession;
    $data["bilans"] = $this->Menus_m->getBilansBySession($idSession);
    $this->load->view('Bilans_v', $data);
  }

  /** Bilan de id $idBilan */
  public function get($idBilan) {
    $data["bilan"] = $this->Bilan_m->get($idBilan);
    $this->load->view('Bilan_v', $data);
  }

}
