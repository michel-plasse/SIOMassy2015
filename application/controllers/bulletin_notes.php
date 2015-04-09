<?php

class Bulletin_notes extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('bulletin_notes_m');
    }

    public function index() {
        $this->load->view('bulletin_notes_v');
    }
}