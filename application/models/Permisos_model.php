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
            $sql = "SELECT permisos.id AS id_permiso, id_modulo,id_perfil,permisos.activo,modulos.descripcion AS modulo_descrip, perfiles.descripcion as perfiles_descrip
				FROM permisos INNER JOIN modulos ON permisos.id_modulo = modulos.id
				     INNER JOIN perfiles ON perfiles.id = permisos.`id_perfil` WHERE id_perfil = ? ";
            $query = $this->db->query($sql, array($id_perfil));
            return $query->result_array();
        }

        public function get_permiso_modulo($modulo,$id_perfil){
            $sql = "SELECT * FROM permisos as p INNER JOIN modulos as m ON p.id_modulo = m.id WHERE descripcion = ? AND id_perfil = ?";
            $query = $this->db->query($sql, array($modulo,$id_perfil));
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

        public function update_permisos($perfil,$modulo,$estado = false){

            $this->db->set('activo', $estado);

            $this->db->where('id_perfil', $perfil);
            $this->db->where('id_modulo', $modulo);
       
            $this->db->update('permisos'); 
        }
    }
