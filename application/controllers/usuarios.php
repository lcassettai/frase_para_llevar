<?php 
defined('BASEPATH') OR exit('No se permite el ingreso directo');

class Usuarios extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if(!isset($_SESSION['usuario']) || !$_SESSION['activo']){
			redirect('login');
		}

		if($_SESSION['tipo_usuario'] != 1){
			show_error('No tienes permisos para estar aqui',403,'Problema de permisos');
		}
		$this->load->helper('form');
		$this->load->model('usuarios_model');
	}

	public function index(){
		//Obtenemos todos los usuarios		
		$usuarios = $this->usuarios_model->obtener_usuarios();
		$tipo_usuarios = $this->usuarios_model->get_tipo_usuarios();

		$data = array('title' => 'Gestion de usuarios',
					  'usuarios' => $usuarios,
					  'tipo_usuarios' => $tipo_usuarios);

		$this->load->view('templates/header_view',$data);
		$this->load->view('usuarios/usuarios_view',$data);
		$this->load->view('templates/footer_view');
	}

	public function obtener_usuario(){
		$is_valid = GUMP::is_valid($_POST, array(
			'id' => 'required|integer'
		));
		if($is_valid){
			$usuarios = $this->usuarios_model->obtener_usuario_id($_POST['id']);
			exit(json_encode($usuarios));
		}		
	}

	public function eliminar_usuario(){
		$gump = new GUMP();
		$_POST = $gump->sanitize($_POST); 

		$gump->validation_rules(array(
			'id_usuario' => 'integer|integer'
		));

		$validated_data = $gump->run($_POST);

		if($validated_data === false) {
			exit(json_encode(array(false,$gump->get_readable_errors(true))));
		}	

		$this->usuarios_model->eliminar_usuario($_POST['id']);
	}

	public function guardar_datos(){
		$gump = new GUMP();
		$_POST = $gump->sanitize($_POST); 

		$gump->validation_rules(array(
			'id_usuario' => 'integer',
			'usuario' => 'required|max_len,200|min_len,1',
			'nombre' => 'required|valid_name|max_len,200|min_len,1',
			'apellido' => 'required|valid_name|max_len,200|min_len,1',
			'tipo_usuario' => 'required|integer'
		));

		$validated_data = $gump->run($_POST);

		if($validated_data === false) {
			exit(json_encode(array(false,$gump->get_readable_errors(true))));
		}

		//Si esta seteado el id es una modificacion, sino es un alta
		if(!empty($_POST['id_usuario'])){
			$this->usuarios_model->modificar_usuario($_POST);
		}else{
			if(!empty($_POST['passowrd'])){
				$this->usuarios_model->crear_usuario($_POST);
			}else{
				exit(json_encode(array(false,'Debe ingresar un <b>Password</b>')));
			}

		}

		exit(json_encode(array(true,'Se cargaron los datos con exito')));
	}


}
?>