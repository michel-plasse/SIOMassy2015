<?php

class Test_evaluation_m extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('unit_test');
        $this->load->model('evaluation_m');
    }

    public function index() {
        $this->testGetNotesByStagiaire();
    }

    public function testGetNotesByStagiaire() {
        $result = $this->evaluation_m->getNotesByStagiaire(1);
        $expected = array(
            array("id_stagiaire" => 1,
                "nom_module" => "SI2",
                "date_effet" => "2014-11-01",
                "note" => 15.0,
                "id_evaluation" => 1),
            array("id_stagiaire" => 1,
                "nom_module" => "SLAM",
                "date_effet" => "2015-03-24",
                "note" => 17.0,
                "id_evaluation" => 2),
            array("id_stagiaire" => 1,
                "nom_module" => "Maths",
                "date_effet" => "2015-01-10",
                "note" => 18.0,
                "id_evaluation" => 3),
            array("id_stagiaire" => 1,
                "nom_module" => "Anglais",
                "date_effet" => "2015-01-14",
                "note" => 15.0,
                "id_evaluation" => 4)
        );
        echo $this->unit->run($result, $expected, "getStagiaires");
    }

}
