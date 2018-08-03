<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!isset($_SESSION['usuario']) || !$_SESSION['activo']){
			redirect('login');
		}
	}
	
	public function index()
	{
		$this->load->view('templates/header_view',array('title' => 'Inicio'));
		$this->load->view('inicio_view');		
		$this->load->view('templates/footer_view');
	}

}
