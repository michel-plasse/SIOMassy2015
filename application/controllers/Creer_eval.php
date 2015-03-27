<?php

class Creer_eval extends FormController {

    public function __construct() {
        parent::__construct();
    }

    public function print_form() {
        $data["sessions"] = $this->Creer_eval_m->getSessions();
        $this->load->view('Creer_eval_v', $data);
      
    }

    public function process_form() {
        die("pas encore fait");
    }

}
