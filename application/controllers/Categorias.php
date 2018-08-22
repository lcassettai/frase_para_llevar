<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!isset($_SESSION['usuario']) || !$_SESSION['activo']){
			redirect('login');
		}
		$permisos = $this->permisos->get_permiso_modulo('categorias',$_SESSION['id_perfil']);
		if(!$permisos[0]['activo']){
			show_error('Usted no tiene permisos para estar aca',403,'Alto ahi loca!');
		}
		$this->load->helper('form');
		$this->load->model('categorias_model');
	}
	
	public function index()
	{
		$datos = array(
			'categorias' =>$this->obtener_categorias()
			); 
		$this->load->view('templates/header_view',array('title' => 'Categorias'));
		$this->load->view('categorias/categorias_view',$datos);		
		$this->load->view('templates/footer_view');
	}

	public function obtener_categorias(){
		return $this->categorias_model->get_categorias();
	}

}
