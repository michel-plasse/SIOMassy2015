<?php

class Bulletin_notes extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('bulletin_notes_m');
        $this->load->helper('url');
    }

    public function index($id_session, $id_bilan, $id_stagiaire) {
        if ($this->input->server('REQUEST_METHOD') == "GET") {
            $data["stagiaire"] = $this->bulletin_notes_m->getInfosStagiaire($id_session, $id_bilan, $id_stagiaire);
            $data["moyennes"] = $this->bulletin_notes_m->getMoyenneGlobale($id_session, $id_bilan, $id_stagiaire);
            $data["cssUrl"] = base_url("items/css/allproject.css");
            $this->load->view('bulletin_notes_v', $data);
        } else {
            if (isset($_POST['bulletin'])) {
                Bulletin_notes_m::updateBulletin($_POST);
                $url = base_url(uri_string());
                header("Location: $url");
            } elseif (isset($_POST['ligne_b'])) {
                Bulletin_notes_m::updateLigneBulletin($_POST);
                $url = base_url(uri_string());
                header("Location: $url");
            }
        }
    }

}
