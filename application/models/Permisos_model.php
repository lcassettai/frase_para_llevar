<?php 
    defined('BASEPATH') or exit('No se puede al script de manera directa');

    class Permisos_model extends CI_Model
    {
        public function __construct()
        {
            $this->load->database();
        }

        public function get_all_permisos($id_perfil = null)
        {
            $sql = "SELECT permisos.id AS id_permiso, id_modulo,id_perfil,crear,leer,actualizar,borrar,modulos.descripcion AS modulo_descrip, perfiles.descripcion as perfiles_descrip
				FROM permisos INNER JOIN modulos ON permisos.id_modulo = modulos.id
				     INNER JOIN perfiles ON perfiles.id = permisos.`id_perfil` WHERE id_perfil = ? ";
            $query = $this->db->query($sql, array($id_perfil));
            return $query->result_array();
        }

        public function get_all_perfiles()
        {
            $query = $this->db->get_where('perfiles', array('activo' => 1));
            return $query->result_array();
        }

        public function get_all_modulos()
        {
            $query = $this->db->get_where('modulos');
            return $query->result_array();
        }
    }
