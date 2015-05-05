<?php

class Bulletins_notes extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('bulletin_notes_m');
    }

    public function index() {
        $data["stagiaires"] = $this->bulletin_notes_m->getAll();
        $data["cssUrl"] = base_url("items/css/allproject.css");
        $this->load->view('bulletins_notes_v', $data);
    }

}
