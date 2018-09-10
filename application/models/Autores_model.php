<?php
class autores_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    /**
     * Obtiene todos los autores, Opcionalmente si recibe un id por parametro devuelve un autor especifico
     * @param int id del autor
     * @return array arreglo con todos los autores
    */
        
    public function get_autores($id = null,$inicio = null,$limite = null)
    {
        if(isset($id)){
             $this->db->where('id', $id);
        }

        if(isset($inicio) && isset($limite)){
            $this->db->limit($limite,$inicio);
        }
        
        $this->db->where('activo', 1);

        $query = $this->db->get('autores');
        return $query->result_array();
    }

    public function insert_autor($nombre, $apellido,$fecha,$link)
    {
        $data = array(
                    'nombre' => $nombre,
                    'apellido' => $apellido,
                    'fecha_nacimiento' => $fecha,
                    'link' => $link,
                    'activo' =>1
            );

        $this->db->insert('autores', $data);
    }

    /**
     * Modificar un autor segun su id
     *
     * @param integer $id
     * @param string[150] $nombre
     * @param string[150] $apellido
     * @param date $fecha
     * @param string[400] $link
     */
    public function modificar_autor($id, $nombre, $apellido,$fecha,$link)
    {
        $this->db->set('id', $id);
        $this->db->set('nombre', $nombre);
        $this->db->set('apellido', $apellido);
        $this->db->set('fecha_nacimiento', $fecha);
        $this->db->set('link', $link);

        $this->db->where('id', $id);
   
        $this->db->update('autores');
    }

    /**
     * Eliminar un autor segun su id
     * @param  int $id [id del autor]
     */
    
    public function eliminar_autor($id)
    {
        $this->db->set('activo', 0);
        $this->db->where('id', $id);
        $this->db->update('autores');
    }
}
?>
