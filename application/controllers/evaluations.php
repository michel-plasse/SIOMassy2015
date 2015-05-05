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

    /* Donne une note au stagiaire sur l'évaluation */

    function note() {
        // Recupere les notes et les id_stagiaire, ainsi que l'id_evaluation
        $id_evaluation = $this->input->post("id_evaluation");
        $id_stagiaires = $this->input->post("id_stagiaire");
        $notes = $this->input->post("note");
        // pour chaque stagiaire inserer ou maj la note
        for ($i=0 ; $i<count($notes) ; $i++) {
            $this->evaluation_m->updateNote($id_stagiaires[$i], $id_evaluation, $notes[$i]);
        }
        redirect("/evaluations/get/$id_evaluation");
    }
    
    function  mobile($idStagiaire){
        header("Content-type: text/plain; charset=UTF-8");
        $notes = $this->evaluation_m->getNotesByStagiaire($idStagiaire);
        $result = array();
        foreach ($notes as $note) {
            $result[] = implode(";", $note);
        }
        print join("\n", $result);
    }
    
}
