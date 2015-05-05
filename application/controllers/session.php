<?php

require_once "FormController.php";

class Session extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    /** Affiche la liste des sessions. Pas fait => envoie vers la session 1 */
    public function index() {
//        $this->load->helper('url');
        redirect("/session/intervenants/1");
    }
    
    public function intervenants($idSession) {
            switch ($_SERVER["REQUEST_METHOD"]) {
            case "GET":
                $this->print_form($idSession);
                break;
            case "POST":
                $this->process_form($idSession);
                break;
            default:
                die("Http method not implemented");
        }
    }
    
    public function print_form($idSession) {
        $this->load->model("menus_m");
        // Puis les formateurs (peut-être à filtrer par module)
        $data["formateurs"] = $this->menus_m->getFormateurs();
        $data["modules"] = $this->menus_m->getModulesByIdSession($idSession);
        $this->load->helper('form');
        $this->load->view('session_v', $data);
    }

    public function process_form($idSession) {
        die("module=$_POST[id_module] action=$_POST[action] id_formateur=$_POST[id_formateur]");
    }

}
