<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inicio extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        verificar_permisos('inicio', false);
    }
    
    public function index()
    {
        $this->load->model('usuarios_model');
        $this->load->model('categorias_model');
        $usuarios = $this->usuarios_model->obtener_usuarios();
        $categorias = $this->categorias_model->get_categorias();

        $datos = array(
            'cant_usuarios' => count($usuarios),
            'cant_categorias' => count($categorias)
            );
        $this->load->view('templates/header_view', array('title' => 'Inicio'));
        $this->load->view('inicio_view', $datos);
        $this->load->view('templates/footer_view');
    }
}
