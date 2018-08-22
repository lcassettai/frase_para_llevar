<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frases extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!isset($_SESSION['usuario']) || !$_SESSION['activo']){
			redirect('login');
		}
		$permisos = $this->permisos->get_permiso_modulo('frases',$_SESSION['id_perfil']);
		if(!$permisos[0]['activo']){
			show_error('Usted no tiene permisos para estar aca',403,'Alto ahi loca!');
		}
	}
	
	public function index()
	{
		$this->load->view('templates/header_view',array('title' => 'Frases'));
		$this->load->view('Frases/frases_view');		
		$this->load->view('templates/footer_view');
	}

}
