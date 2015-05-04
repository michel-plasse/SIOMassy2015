<?php
require_once "FormController.php";

class Session extends FormController {

    public function __construct() {
        parent::__construct();
    }

    public function print_form() {
        $this->load->model("Menus_m");
       
        $data["modules"] = $this->Menus_m->getModules();
        // Puis les formateurs (peut-être à filtrer par module)
        $data["formateurs"] = $this->Menus_m->getFormateurs();
        
        $this->load->helper('form');
        $this->load->view('session_v', $data);
    }

    public function process_form() {
        die("pas encore fait");
    }

}
