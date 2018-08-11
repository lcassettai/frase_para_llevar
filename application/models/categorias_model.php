<?php
class categorias_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        public function get_categorias(){
            $query = $this->db->get_where('categorias', array('activo' => 1));    
            return $query->result_array();
        }
}
