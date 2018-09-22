<?php 
    defined('BASEPATH') or exit('No se permiten scripts directos');

class Autores extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        verificar_permisos('autores');
        $this->load->model('usuarios_model');
        $this->load->model('autores_model');
    }

    public function index($pagina = false)
    {
        $this->load->library('Pagination');

        $inicio = 0;
        $limite = 5;

        if ($pagina) {
            $inicio = ($pagina -1) * $limite;
        }

        $datos = array('autores' =>  $this->autores_model->get_autores(null, $inicio, $limite));

        //Url base que mostrara, ver routes.php
        $config['base_url'] = base_url().'pagina_autor/';
        //Cantidad de filas devueltas para calcular el total del paginador
        $config['total_rows'] = count($this->autores_model->get_autores());
        //Cantidad de items por pagina
        $config['per_page'] = $limite;
        //Indicamos cual va a ser la url principal si no se ingresa un numero de pagina
        $config['first_url'] = base_url().'autores/';
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
        
        $this->load->view('templates/header_view', array('title' => 'Autores'));
        $this->load->view('autores/autores_view', $datos);
        $this->load->view('templates/footer_view');
    }

    public function guardar_autor()
    {
        $gump = new GUMP('es');
        $_POST = $gump->sanitize($_POST);

        $gump->validation_rules(array(
            'id_autor' => 'integer',
            'apellido_autor' => 'required|max_len,100|min_len,1',
            'nombre_autor' => 'required|max_len,100|min_len,1',
            'url_bio' => 'valid_url|max_len,500',
            'fecha_nacimiento' => 'date'
        ));

        $validated_data = $gump->run($_POST);

        if ($validated_data === false) {
            exit(json_encode(array(false,$gump->get_readable_errors(true))));
        }

        //Si esta seteado el id es una modificacion, sino es un alta
        if (!empty($_POST['id_autor'])) {
            $this->autores_model->modificar_autor($_POST['id_autor'], $_POST['nombre_autor'], $_POST['apellido_autor'], $_POST['fecha_nacimiento'], $_POST['url_bio']);
            $this->usuarios_model->registrar_operacion($_SESSION['id'], 'modificar autor', 'modifico el autor '.$_POST['apellido_autor']);
        } else {
            $this->autores_model->insert_autor($_POST['nombre_autor'], $_POST['apellido_autor'], $_POST['fecha_nacimiento'], $_POST['url_bio']);
            $this->usuarios_model->registrar_operacion($_SESSION['id'], 'crear autor', 'creo el autor '.$_POST['apellido_autor']);
        }

        exit(json_encode(array(true,'Se cargaron los datos con exito')));
    }
    
    public function obtener_autor()
    {
        $gump = new GUMP('es');
        $_POST = $gump->sanitize($_POST);

        $gump->validation_rules(array(
            'id_autor' => 'required|integer'
        ));

        $validated_data = $gump->run($_POST);

        if ($validated_data === false) {
            exit(json_encode(array(false,$gump->get_readable_errors(true))));
        }

        $datos_autor = $this->autores_model->get_autores($_POST['id_autor']);

        exit(json_encode(array(true,$datos_autor)));
    }
    
    public function eliminar_autor()
    {
        $gump = new GUMP('es');
        $_POST = $gump->sanitize($_POST);

        $gump->validation_rules(array(
            'id_autor' => 'required|integer'
        ));

        $validated_data = $gump->run($_POST);

        if ($validated_data === false) {
            exit(json_encode(array(false,$gump->get_readable_errors(true))));
        }

        $this->autores_model->eliminar_autor($_POST['id_autor']);
        
        exit(json_encode(array(true,"Se elimino la categoria con exito")));
    }
}
