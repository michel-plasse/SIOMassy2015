<?php

class Evaluations extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    /** Evaluation de id $idEval */
    function get($idEval) {
        $this->load->model("Evaluation_m");
        $data["evaluation"] = $this->Evaluation_m->getById($idEval);
        $this->load->view("listeEval_v", $data);
    }

    function index() {
       // ALler en dur vers SIO 2015
        redirect(current_url()."/get/1");
    }

}
