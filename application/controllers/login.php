<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('form');
	}


	public function index()
	{
		if(isset($_SESSION['usuario']) && !empty($_SESSION['usuario'])){
			redirect('inicio');
		}

		$this->load->view('login/login_view');
	}

	public function logout(){
		$_SESSION = array();
		session_destroy();
		$this->load->view('login/login_view');
	}

	public function verificar_credenciales(){
        $this->load->library('form_validation');

        $this->form_validation->set_rules('usuario', 'usuario', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');

        if ($this->form_validation->run() === FALSE)
        {
        	$data = array('errores' => validation_errors());
            $this->load->view('login/login_view',$data);
        }
        else
        {
        	$usuario = $this->input->post('usuario');
        	$pass = $this->input->post('password');
            $this->load->model('usuarios_model');
			$datos = $this->usuarios_model->obtener_usuario($usuario,$pass);

			if(!empty($datos)){
				$_SESSION['usuario'] = $datos[0]['usuario'];
				$_SESSION['tipo_usuario'] = $datos[0]['tipo_usuario'];
				$_SESSION['nombre'] = $datos[0]['nombre'];
				$_SESSION['apellido'] = $datos[0]['apellido'];
				$_SESSION['activo'] = $datos[0]['activo'];

			if (!empty($_POST['recordarme'])){
				setcookie("usuario",$datos[0]['usuario'],time()+(60*60*24*365),"/");
				setcookie("pass",$pass,time()+(60*60*24*365),"/");
				setcookie("recordarme",true,time()+(60*60*24*365),"/");
			}else{
				setcookie("usuario","",time()-1000,"/");
				setcookie("pass","",time()-1000,"/");
				setcookie("recordarme",false,time()-1000,"/");
			}		 
				
			redirect('inicio');

			}else{
				$data = array('errores' => 'Usuario o contraseña incorrectos');
				$this->load->view('login/login_view',$data);
			}	
       }
	}
}
