<?php

class Bilans extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('Menus_m');
  }

  public function index() {
    $data["sessions"] = $this->Menus_m->getSessionsEnCours();
    $data["bilans"] = $this->Menus_m->getBilanBySession($id_session);
    $this->load->view('Bilans_v', $data);
  }

}
