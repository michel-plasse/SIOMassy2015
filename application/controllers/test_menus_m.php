<?php

/** Session de formation (modèle) */
class Test_menus_m extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('unit_test');
        $this->load->model('menus_m');
    }

    public function index() {
        $this->testGetSessionsEnCours();
        $this->testGetStagiaires();
        $this->testGetModuleByIdSession();
    }

    /** Sessions en cours sous forme d'un tableau associatif value => nom.
     * PAS TERMINE : prend toutes les sessions !
     */
    public function testGetSessionsEnCours() {
        // Valeur attendue
        $expected = array(
            1 => "BTS SIO 2016",
            2 => "BTS CG 2016",
            3 => "BTS Audio 2016"
        );
        // Valeur reçue
        $result = $this->menus_m->getSessionsEnCours();
        // Lancer le test et afficher le résultat
        echo $this->unit->run($result, $expected, "getSessionsEnCours");
    }

    public function testGetStagiaires() {
        $excepted = array(
            1 => "Joel BANKA",
            2 => "Stephanie BRIERRE",
            3 => "Marion DESCIEUX"
        );
        $reponse = $this->menus_m->getStagiaires(1);
        echo $this->unit->run($reponse, $excepted, "getStagiaires");
    }

    public function testGetModuleByIdSession() {
        $excepted = array(
            '1' => 'SI2',
            '2' => 'Maths',
            '3' => 'Anglais',
            '10' => 'Culture générale',
            '11' => 'Economie-droit',
            '12' => 'Algorithmique',
            '13' => 'SLAM',
            '14' => 'SISR'
        );
        $reponse = $this->menus_m->getModulesByIdSession(1);
        echo $this->unit->run($reponse, $excepted, "getModulesByIdSession");
        
    }

}
