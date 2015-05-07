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
        $this->load->model("intervenant_m");
        // Puis les formateurs (peut-être à filtrer par module)
        $data["formateurs"] = $this->menus_m->getFormateurs();
        $data["modules"] = $this->menus_m->getModulesByIdSession($idSession);
        $data["formateursParModule"] = $this->intervenant_m->getIntervenants($idSession);
        $data["id_session"] = $idSession;
        $this->load->view('session_v', $data);
    }

    public function process_form($id_session) {
        $this->load->model('intervenant_m');
        switch ($this->input->post("action")) {
            case "ajouter":
                $id_module = $this->input->post("id_module");
                $id_formateur = $this->input->post("id_formateur");
                try {
                    $this->intervenant_m->ajouter($id_session, $id_module, $id_formateur);
                }
                catch (Exception $exc) {
                    die($exc->getCode());
                }
                redirect(current_url());
                break;
            case "supprimer":
                $id_module = $this->input->post("id_module");
                $id_formateur = $this->input->post("id_formateur");
                $this->intervenant_m->supprimer($id_session, $id_module, $id_formateur);
                redirect(current_url());
                break;
            default :
                break;
        }
        //die("module=$_POST[id_module] action=$_POST[action] id_formateur=$_POST[id_formateur]");
    }

}
