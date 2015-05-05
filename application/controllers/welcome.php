<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Welcome extends CI_Controller {

  /**
   * Index Page for this controller.
   *
   * Maps to the following URL
   * 		http://example.com/index.php/welcome
   * 	- or -
   * 		http://example.com/index.php/welcome/index
   * 	- or -
   * Since this controller is set as the default controller in
   * config/routes.php, it's displayed at http://example.com/
   *
   * So any other public methods not prefixed with an underscore will
   * map to /index.php/welcome/<method_name>
   * @see http://codeigniter.com/user_guide/general/urls.html
   */
  public function index() {
    $this->load->model('menus_m');
    try {
      $data["sessions"] = $this->menus_m->getSessionsEnCours();
      $data["cssUrl"] = base_url("items/css/allproject.css");
      $this->load->view('welcome_v', $data);
    } catch (Exception $exc) {
      $data["exception"] = $exc;
      $this->load->view('erreur');
    }
  }
  

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */