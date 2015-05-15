<?php

require_once "FormController.php";

class Creer_eval extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('menus_m');
        $this->load->model('creer_eval_m');
    }

    public function index() {
        if ($this->input->server('REQUEST_METHOD') == "GET") {
            // Recuperer les sessions
            $data["sessions"] = $this->menus_m->getSessionsEnCours();
            // Modules (toutes formations confondues => a ameliorer)
            $data["modules"] = $this->menus_m->getModules();
            // Puis les formateurs (peut-être à filtrer par module)
            $data["formateurs"] = $this->menus_m->getFormateurs();
            $data["cssUrl"] = base_url("items/css/allproject.css");
            $data["cssBPUrl"] = base_url("items/css/BeatPicker.min.css");
            $data["jsBPUrl"] = base_url("items/js/BeatPicker.min.js");
            $data["biblioJSUrl"] = base_url("items/js/jquery.1.8.3.js");
            // Afficher la vue en s'aidant du helper form
            // (pour le form_dropdown)
            $this->load->view('creer_eval_v', $data);
        } else {
            if (isset($_POST['insert_eval'])) {
                $data["insertion"] = $_POST[''];
                        
                $this->load->view('creer_eval_v',data);
//                Creer_eval_m::insert($_POST);
//                redirect(uri_string());
            }
        }
    }

}
