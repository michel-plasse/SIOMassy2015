<?php

class Bilans extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('menus_m');
    $this->load->model('bilan_m');
  }

  public function index() {
    $data["bilans"] = $this->bilan_m->getAll();
    $this->load->view('bilans_v', $data);
//    $this->session(1);
  }

  /** Bilans de la session de id $idSession */
//  public function session($idSession) {
//    $data["id_session"] = $idSession;
//    $data["bilans"] = $this->Menus_m->getBilansBySession($idSession);
//    $this->load->view('Bilans_v', $data);
//  }

  /** Bilan de id $idBilan */
  public function get($idBilan) {
    $data["bilan"] = $this->bilan_m->get($idBilan);
    $this->load->view('bilan_v', $data);
  }

}
