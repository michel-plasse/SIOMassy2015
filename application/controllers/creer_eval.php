<?php

require_once "FormController.php";

class Creer_eval extends FormController {

    public function __construct() {
        parent::__construct();
    }

    public function print_form() {
        $this->load->model("Menus_m");
        // Recuperer les sessions
        $data["sessions"] = $this->Menus_m->getSessionsEnCours();
        // Puis les modules de la session (si positionnée)
//    $idSession = filter_input(INPUT_GET, "idSession");
//    $data["modules"] = ($idSession == NULL)
//            ? array()
//            : $this->Menus_m->getModulesByIdSession($idSession);
        // Modules (toutes formations confondues => a ameliorer)
        $data["modules"] = $this->Menus_m->getModules();
        // Puis les formateurs (peut-être à filtrer par module)
        $data["formateurs"] = $this->Menus_m->getFormateurs();
        // Afficher la vue en s'aidant du helper form
        // (pour le form_dropdown)
        $this->load->helper('form');
        $this->load->view('Creer_eval_v', $data);
    }

    public function process_form() {
        die("pas encore fait");
    }

}
