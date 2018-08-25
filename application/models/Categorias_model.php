<?php
class categorias_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    /**
     * Obtiene todas las categorias, Opcionalmente si recibe un id por parametro devuelve la cateogira especifica
     * @param int id de la categoria
     * @return array arreglo con todas las categorias
    */
        
    public function get_categorias($id = null,$inicio = null,$limite = null)
    {
        if(isset($id)){
             $this->db->where('id', $id);
        }

        if(isset($inicio) && isset($limite)){
            $this->db->limit($limite,$inicio);
        }
        
        $this->db->where('activo', 1);

        $query = $this->db->get('categorias');
        return $query->result_array();
    }

    /**
     * Inserta una nueva categoria
     * @param  string[100]  $nombre      nombre que se mostrara
     * @param  string[1000] $descripcion descripcion de la categoria
    */
        
    public function insert_categoria($nombre, $descripcion)
    {
        $data = array(
                    'nombre' => $nombre,
                    'descripcion' => $descripcion,
                    'activo' => 1
            );

        $this->db->insert('categorias', $data);
    }

    /**
     * Actualizar datos de una categoria especifica
     * @param  int $id          id de la categoria
     * @param  string $nombre      nombre de la categeoria
     * @param  string $descripcion detalles adiciones
     */
    
    public function modificar_categoria($id, $nombre, $descripcion)
    {
        $this->db->set('id', $id);
        $this->db->set('nombre', $nombre);
        $this->db->set('descripcion', $descripcion);

        $this->db->where('id', $id);
   
        $this->db->update('categorias');
    }

    /**
     * Eliminar una categoria segun su id
     * @param  int $id [id de la categoria]
     */
    
    public function eliminar_categoria($id)
    {
        $this->db->set('activo', 0);
        $this->db->where('id', $id);
        $this->db->update('categorias');
    }
}
