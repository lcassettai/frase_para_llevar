<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Categorias extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        verificar_permisos('categorias');
        $this->load->helper('form');
        $this->load->model('categorias_model');
        $this->load->model('usuarios_model');
    }
    
    public function index($pagina = false)
    {
        $this->load->library('Pagination');

        $inicio = 0;
        $limite = 5;

        if ($pagina) {
            $inicio = ($pagina -1) * $limite;
        }

        $datos = ['categorias' => $this->categorias_model->get_categorias(null, $inicio, $limite)];

        //Url base que mostrara, ver routes.php
        $config['base_url'] = base_url().'pagina/';
        //Cantidad de filas devueltas para calcular el total del paginador
        $config['total_rows'] = count($this->categorias_model->get_categorias());
        //Cantidad de items por pagina
        $config['per_page'] = $limite;
        //Indicamos cual va a ser la url principal si no se ingresa un numero de pagina
        $config['first_url'] = base_url().'categorias/';
        //Cantidad de links que se mostraran de a la izquierda y derecha del seleccionado
        $config['num_links'] = 4;

        //Agregamos etiquetas HTML a los links de la paginacion para darles estilos
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="paginate_button ">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="paginate_button active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_tag_open'] = '<li class="paginate_button">';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="paginate_button">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Siguiente';
        $config['prev_link'] = 'Atras';
        

        $this->pagination->initialize($config);

        $this->load->view('templates/header_view', array('title' => 'Categorias'));
        $this->load->view('categorias/categorias_view', $datos);
        $this->load->view('templates/footer_view');
    }

    public function obtener_categoria()
    {
        $gump = new GUMP('es');
        $_POST = $gump->sanitize($_POST);

        $gump->validation_rules(array(
            'id_categoria' => 'required|integer'
        ));

        $validated_data = $gump->run($_POST);

        if ($validated_data === false) {
            exit(json_encode(array(false,$gump->get_readable_errors(true))));
        }

        $datos_categoria = $this->categorias_model->get_categorias($_POST['id_categoria']);

        exit(json_encode(array(true,$datos_categoria)));
    }

    public function eliminar_categoria()
    {
        $gump = new GUMP('es');
        $_POST = $gump->sanitize($_POST);

        $gump->validation_rules(array(
            'id_categoria' => 'required|integer'
        ));

        $validated_data = $gump->run($_POST);

        if ($validated_data === false) {
            exit(json_encode(array(false,$gump->get_readable_errors(true))));
        }

        $datos_categoria = $this->categorias_model->eliminar_categoria($_POST['id_categoria']);
        
        exit(json_encode(array(true,"Se elimino la categoria con exito")));
    }

    public function guardar_categoria()
    {
        $gump = new GUMP('es');
        $_POST = $gump->sanitize($_POST);

        $gump->validation_rules(array(
            'id_categoria' => 'integer',
            'nombre' => 'required|max_len,100|min_len,1',
            'descripcion' => 'max_len,1000'
        ));

        $validated_data = $gump->run($_POST);

        if ($validated_data === false) {
            exit(json_encode(array(false,$gump->get_readable_errors(true))));
        }

        //Si esta seteado el id es una modificacion, sino es un alta
        if (!empty($_POST['id_categoria'])) {
            $this->categorias_model->modificar_categoria($_POST['id_categoria'], $_POST['nombre'], $_POST['descripcion']);
            $this->usuarios_model->registrar_operacion($_SESSION['id'], 'modificar categoria', 'modifico la categoria '.$_POST['nombre']);
        } else {
            $this->categorias_model->insert_categoria($_POST['nombre'], $_POST['descripcion']);
            $this->usuarios_model->registrar_operacion($_SESSION['id'], 'crear categoria', 'creo la categoria '.$_POST['nombre']);
        }

        exit(json_encode(array(true,'Se cargaron los datos con exito')));
    }
}
