<?php
    function assets_url($asset)
    {
        return base_url().$asset.'/';
    }

    function obtener_version()
    {
        $fp = fopen(base_url()."version", "r");
        $version = fgets($fp);
        fclose($fp);
        return $version;
    }

    /**
     * Verificamos los permisos del usuario segun su perfil y si inico sesion
     *
     * @param String $operacion //Autores, Frases, etc
     * @return void
     */
    function verificar_permisos($operacion, $verificar_permiso = true)
    {
        //Verificamos el inicio de sesion
        if (!isset($_SESSION['usuario']) || !$_SESSION['activo']) {
            redirect('login');
        }
        
        //Verificamos el permiso de la operacion
        if ($verificar_permiso) {
            $CI =& get_instance();
            
            $permisos = $CI->permisos->get_permiso_modulo($operacion, $_SESSION['id_perfil']);
            if (!$permisos[0]['activo']) {
                show_error('Usted no tiene permisos para estar aca', 403, 'Alto ahi loca!');
            }
        }
    }
