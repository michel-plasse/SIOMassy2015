<?php

class Test_intervenant_m extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('unit_test');
        $this->load->model('intervenant_m');
    }

    public function index() {
        $this->testGetIntervenants();
    }

    public function testGetIntervenants() {
        $result = $this->intervenant_m->getIntervenants(1);
        $expected = array(
            '2' => array('7' => 'Boussad AIT ALI BRAHAM'),
            '3' => array('6' => 'Catherine HORCHANI'),
            '10' => array('22' => 'Blanche COURTEAU'),
            '11' => array('23' => 'Mathieu RENOUF',
                '24' => 'Alexandre MASSON'),
            '12' => array('7' => 'Boussad AIT ALI BRAHAM'),
            '13' => array('27' => 'Salim HAMIDOU',
                '26' => 'Fatma HAMOUDA',
                '4' => 'Michel PLASSE', 
                '28' => 'Jean-françois POIVEY',
            ),
            '14' => array('25' => 'Jean GAUTHIER',
                '5' => 'Pascal SORIN'),
        );
//        header("Content-type: text/plain; charset=utf8");
//        print_r($expected);
//        print_r($result);
        echo $this->unit->run($result, $expected, "getIntervenants");
    }

}
