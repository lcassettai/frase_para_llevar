<?php 
defined('BASEPATH') OR exit('No se permite el ingreso directo');

class Usuarios extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if(!isset($_SESSION['usuario']) || !$_SESSION['activo']){
			redirect('login');
		}

		$permisos = $this->permisos->get_permiso_modulo('usuarios',$_SESSION['id_perfil']);
			if(!$permisos[0]['activo']){
				show_error('Usted no tiene permisos para estar aca',403,'Alto ahi loca!');
			}
		$this->load->helper('form');
		$this->load->model('usuarios_model');
	}

	public function index(){
		//Obtenemos todos los usuarios		
		$usuarios = $this->usuarios_model->obtener_usuarios();
		$perfiles = $this->usuarios_model->get_perfiles();

		$data = array('title' => 'Gestion de usuarios',
					  'usuarios' => $usuarios,
					  'perfiles' => $perfiles);

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
		$gump = new GUMP('es');
		$_POST = $gump->sanitize($_POST); 

		$gump->validation_rules(array(
			'id' => 'required|integer'
		));

		$validated_data = $gump->run($_POST);

		if($validated_data === false) {
			exit(json_encode(array(false,$gump->get_readable_errors(true))));
		}	

		$usuario = $this->usuarios_model->obtener_usuario_x_usuario('lcassettai');

		if($usuario[0]['id'] == $_POST['id']){
			exit(json_encode(array(false,'No puedes eliminar a dios')));
		}

		if($_SESSION['id'] == $_POST['id']){
			exit(json_encode(array(false,'No puedes eliminar tu usuario')));
		}

		$this->usuarios_model->registrar_operacion($_SESSION['id'],'eliminar usuario','Elimino al usuario con id '.$_POST['id']);
		$this->usuarios_model->eliminar_usuario($_POST['id']);
		exit(json_encode(array(true,'Exito al eliminar!')));
	}

	public function obtener_historial_usuario(){
		$gump = new GUMP('es');
		$_POST = $gump->sanitize($_POST); 

		$gump->validation_rules(array(
			'id_usuario' => 'required|integer'
		));

		$validated_data = $gump->run($_POST);

		if($validated_data === false) {
			exit(json_encode(array(false,$gump->get_readable_errors(true))));
		}	

		exit(json_encode($this->usuarios_model->obtener_operaciones_historial($_POST['id_usuario'])));
	}

	public function guardar_datos(){
		$gump = new GUMP('es');
		$_POST = $gump->sanitize($_POST); 

		$gump->validation_rules(array(
			'id_usuario' => 'integer',
			'usuario' => 'required|max_len,200|min_len,1',
			'nombre' => 'required|valid_name|max_len,200|min_len,1',
			'apellido' => 'required|valid_name|max_len,200|min_len,1',
			'id_perfil' => 'required|integer'
		));

		$validated_data = $gump->run($_POST);

		if($validated_data === false) {
			exit(json_encode(array(false,$gump->get_readable_errors(true))));
		}

		//Si esta seteado el id es una modificacion, sino es un alta
		if(!empty($_POST['id_usuario'])){
			$this->usuarios_model->modificar_usuario($_POST);
			$this->usuarios_model->registrar_operacion($_SESSION['id'],'modificar usuario','modifico el usuario '.$_POST['usuario']);
		}else{
			if(!empty($_POST['password'])){
				$this->usuarios_model->crear_usuario($_POST);
				$this->usuarios_model->registrar_operacion($_SESSION['id'],'crear usuario','creo el usuario '.$_POST['usuario']);
			}else{
				exit(json_encode(array(false,'Debe ingresar un <b>Password</b>')));
			}

		}

		exit(json_encode(array(true,'Se cargaron los datos con exito')));
	}


}
?>
