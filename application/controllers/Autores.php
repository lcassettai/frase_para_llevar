<?php 
	defined('BASEPATH') OR exit('No se permiten scripts directos');

class Autores extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if(!isset($_SESSION['usuario']) || !$_SESSION['activo']){
			redirect('login');
		}
	}

	public function index()
	{
		$this->load->view('templates/header_view',array('title' => 'Autores'));
		$this->load->view('autores/autores_view');		
		$this->load->view('templates/footer_view');
	}
}

?>
