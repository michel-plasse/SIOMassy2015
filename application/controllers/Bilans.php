<?php

class Bilans extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('Menus_m');
  }

  public function index() {
    $data["sessions"] = $this->Menus_m->getSessionsEnCours();
    $this->load->view('Bilans_v', $data);
  }

}
