<?php
class Usuarios_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        //Obtiene un usuario especifico
        public function obtener_usuario($usuario,$password){
        	$query = $this->db->get_where('usuarios', array(
        		'usuario' => $usuario,
                'activo' =>1
        		));
        	
            $resultado = $query->result_array();
            if(!empty($resultado)){ 
                if(password_verify($password, $resultado[0]['password'])){
                    return $resultado;
                }
            }
            
            return null;
        }

        //Obtiene todos los usuarios
        public function obtener_usuarios(){
        	$query = $this->db->get_where('usuarios', array('activo' => 1));	
            return $query->result_array();
        }

        //Obtener el usuario por id
        public function obtener_usuario_id($id){
        	$query = $this->db->get_where('usuarios', array(
        		'id' => $id
        		));
        	
            return $query->result_array();
        }

        //Obtenemos los distintos tipos de usuarios
        public function get_tipo_usuarios(){
        	$query = $this->db->get('tipo_usuarios');        	
            return $query->result_array();
        }

        public function crear_usuario($datos){
            $data = array(
                    'usuario' => $datos['usuario'],
                    'nombre' => $datos['nombre'],
                    'apellido' => $datos['apellido'],
                    'password' => password_hash($datos['password'], PASSWORD_DEFAULT),
                    'tipo_usuario' => $datos['tipo_usuario'],
                    'activo' => 1
            );

            $this->db->insert('usuarios', $data);           
        }

        public function modificar_usuario($datos){
            $this->db->set('usuario', $datos['usuario']);
            $this->db->set('nombre', $datos['nombre']);
            $this->db->set('apellido', $datos['apellido']);
            $this->db->set('tipo_usuario', $datos['tipo_usuario']);
            
            if(!empty($datos['password'])){
                 $this->db->set('password', password_hash($datos['password'], PASSWORD_DEFAULT));
            }           

            $this->db->where('id', $datos['id_usuario']);
       
            $this->db->update('usuarios');           
        }

        public function eliminar_usuario($id){
            $this->db->set('activo', 0);
            $this->db->where('id', $id['id']);       
            $this->db->update('usuarios');
        }

        public function obtener_operaciones_historial($id){
            $this->db->limit(30);
            $this->db->order_by("fecha_hora", "desc");
            $this->db->order_by("fecha_hora", "desc");
            $query = $this->db->get_where('control_usuarios', array(
                'id_usuario' => $id
                ));
            
            return $query->result_array();
        }

        public function registrar_operacion($datos,$tipo_operacion){
            date_default_timezone_set('America/Argentina/Buenos_Aires');
             $data = array(
                    'id_usuario' => $datos,
                    'fecha_hora' => date('Y-m-d H:i:s'),
                    'operacion' => $tipo_operacion
            );

            $this->db->insert('control_usuarios', $data); 
        }
}
