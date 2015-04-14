<?php

class Bilans extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('menus_m');
        $this->load->model('bilan_m');
    }

    public function index() {
        if ($this->input->server('REQUEST_METHOD') == "GET") {
            $this->load->helper(array('form', 'url'));
            $data["bilans"] = $this->bilan_m->getAll();
            $this->load->view('bilans_v', $data);
        } else {
            // valider les données
            // Charge les outils pour les formulaires
            $this->load->helper('form');
            $this->load->library('form_validation');
            // Etablit les règles
            $this->form_validation->set_rules('id_session', 'ID session', 'required|integer');
            $this->form_validation->set_rules('date', 'date', 'required');
            // Modifie la forme des messages d'erreur
            $this->form_validation->set_error_delimiters('<span class="error">', '</span>');

            if (!$this->form_validation->run()) {
                // Il y a des erreurs => réafficher le formulaire
                $this->load->helper(array('form', 'url'));
                $data["bilans"] = $this->bilan_m->getAll();
                $this->load->view('bilans_v', $data);
            } else {
                //Pas d'erreurs => suite du traitement
                $this->load->helper('url');
                Bilan_m::insert($_POST);
                $url = base_url(uri_string());
                header("Location: $url");
            }
        }
    }

    /** Bilan de id $idBilan */
    public function get($idBilan) {
        $data["bilan"] = $this->bilan_m->get($idBilan);
        $this->load->view('bilan_v', $data);
    }

}
