<?php

class Evaluations extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->helper('url');
    $this->load->model("evaluation_m");
    header("Content-type: text/html; charset=UTF-8");
  }

  /** Evaluation de id $idEval */
  function get($idEval) {
    $data["evaluation"] = $this->evaluation_m->getById($idEval);
    $data["notes"] = $this->evaluation_m->getNotesByIdEval($idEval);
    $this->load->view("evaluation_v", $data);
  }

  /** Evaluations de id_session $idSession */
  function session($idSession) {
    $data["idSession"] = $idSession;
    $data["urlGet"] = base_url("evaluations/get");
    $data["evaluations"] = $this->evaluation_m->getBySession($idSession);
    $this->load->view("evaluations_v", $data);
  }

  function index() {
    // ALler en dur vers SIO 2015
    redirect(base_url("/evaluations/session/1"));
  }

}
