<?php
/** Controleur base sur un formulaire :
 * en GET, affiche le formulaire vierge ou prérempli.
 * En POST, met à jour le serveur si pas d'erreur, et réaffiche le formulaire sinon.
 */
abstract class FormController extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        switch ($_SERVER["REQUEST_METHOD"]) {
            case "GET":
                $this->print_form();
                break;
            case "POST":
                $this->process_form();
                break;
            default:
                die("Http method not implemented");
        }
    }

    /** Affiche le formulaire */
    public abstract function print_form();
    
    /** Traitement du formulaire */
    public abstract function process_form();
}
