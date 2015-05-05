<?php

class Bulletins_notes extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('menus_m');
    }

    /** Pour la session 1 uniquement (mise en dur pour l'instant) */
    public function index() {
        $idSession = 1;
        $data["biblioJSUrl"] = base_url("items/js/jquery.1.8.3.js");
        $data["conseils"] = $this->menus_m->getBilansBySession($idSession);
        $data["stagiaires"] = $this->menus_m->getStagiaires($idSession);
        $data["id_session"] = $idSession;
        $data["cssUrl"] = base_url("items/css/allproject.css");
        $this->load->view('bulletins_notes_v', $data);
    }

}
