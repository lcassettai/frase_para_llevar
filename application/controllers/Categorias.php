<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!isset($_SESSION['usuario']) || !$_SESSION['activo']){
			redirect('login');
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
