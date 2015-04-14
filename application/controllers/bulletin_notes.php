<?php

class Bulletin_notes extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('bulletin_notes_m');
        $this->load->helper('url');
    }

    public function index($id_personne, $id_formation) {
        $data["stagiaire"] = $this->bulletin_notes_m->getInfosStagiaire($id_personne);
        $data["modules"] = $this->bulletin_notes_m->getInfosModule($id_formation, $id_personne);
        $data["cssUrl"] = base_url("items/css/allproject.css");

        $this->load->view('bulletin_notes_v', $data);
    }
}