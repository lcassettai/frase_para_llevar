<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Frases extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        verificar_permisos('frases');
    }
    
    public function index()
    {
        $this->load->view('templates/header_view', array('title' => 'Frases'));
        $this->load->view('Frases/frases_view');
        $this->load->view('templates/footer_view');
    }
}
