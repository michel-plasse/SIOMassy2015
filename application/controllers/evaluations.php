<?php

class Evaluations extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->helper('url');
    $this->load->model("Evaluation_m");
  }

  /** Evaluation de id $idEval */
  function get($idEval) {
    $data["evaluation"] = $this->Evaluation_m->getById($idEval);
    $data["notes"] = $this->Evaluation_m->getNotesByIdEval($idEval);
    $this->load->view("Evaluation_v", $data);
  }

  /** Evaluations de id_session $idSession */
  function session($idSession) {
    $data["idSession"] = $idSession;
    $data["urlGet"] = site_url("evaluations/get");
    $data["evaluations"] = $this->Evaluation_m->getBySession($idSession);
    $this->load->view("Evaluations_v", $data);
  }

  function index() {
    // ALler en dur vers SIO 2015
    redirect(current_url() . "/session/1");
  }

}
