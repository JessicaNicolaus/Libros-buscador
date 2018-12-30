<?php if (!defined('BASEPATH')) exit('No permitir el acceso directo al script');

// Validaciones para el modelo de usuarios (login, cambio clave, CRUD Usuario)
class UsuarioLib {

	function __construct() {
		$this->CI = & get_instance(); // Esto para acceder a la instancia que carga la librería

                $this->CI->load->model('Model_Usuario');
                $this->CI->load->model('Model_Perfil');
		
    }

    public function login($user, $pass) {
        //sql a la base de datos
        $query = $this->CI->Model_Usuario->get_login($user, $pass);
        
        //determinar si hay registro con usuario y contraseña
    	if($query->num_rows() > 0) {
            //eligi un registro
            $usuario = $query->row();
            $perfil = $this->CI->Model_Perfil->find($usuario->perfil_id);
            //cargar matriz de sesion
            $datosSession = array('usuario' => $usuario->name,
    			          'usuario_id' => $usuario->id,
    			          'perfil_id' => $usuario->perfil_id,
                                  'perfil_name' => $perfil->name);
            //cargar variable de sesion
            $this->CI->session->set_userdata($datosSession);
            
            return TRUE;
    	}
    	else {
    		return FALSE;
    	}

    }
    
    
    public function cambiarPWD($act, $new) {
        //revisar si usuario esta autenticado
    	if($this->CI->session->userdata('usuario_id') == null) {
    		return FALSE;
    	}

        //recuperar el usuario autenticado
    	$id = $this->CI->session->userdata('usuario_id');
    	$usuario = $this->CI->Model_Usuario->find($id);

        //revisar si la clave funciona
    	if($usuario->password == $act) {
            return TRUE;
    	}
    	else {
    		return FALSE;
    	}
    }
    
     
    public function my_validation($registro) {
               $this->CI->db->where('login', $registro['login']);
        $query = $this->CI->db->get('usuario');
        
        if ($query->num_rows() > 0 AND (!isset($registro['id']) OR ($registro['id'] != $query->row('id')))) {
            return FALSE;
        }
        else {
            return TRUE;
        }
    }



}
