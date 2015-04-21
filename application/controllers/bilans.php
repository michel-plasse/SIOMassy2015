<?php

class Bilans extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('menus_m');
        $this->load->model('bilan_m');
        $this->load->helper('url');
    }

    public function index() {
        if ($this->input->server('REQUEST_METHOD') == "GET") {
            $this->load->helper(array('form', 'url'));
            $data["bilans"] = $this->bilan_m->getAll();
            $data["cssUrl"] = base_url("items/css/allproject.css");
            $data["cssBPUrl"] = base_url("items/css/BeatPicker.min.css");
            $data["jsBPUrl"] = base_url("items/js/BeatPicker.min.js");
            $data["biblioJSUrl"] = base_url("items/js/jquery.1.8.3.js");
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
                $data["cssUrl"] = base_url("items/css/allproject.css");
                $data["cssBPUrl"] = base_url("items/css/BeatPicker.min.css");
                $data["jsBPUrl"] = base_url("items/js/BeatPicker.min.js");
                $data["biblioJSUrl"] = base_url("items/js/jquery.1.8.3.js");
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
