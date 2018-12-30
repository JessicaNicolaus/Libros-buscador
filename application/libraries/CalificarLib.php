<?php if (!defined('BASEPATH')) exit('No permitir el acceso directo al script');

// Validaciones para el modelo de menu_perfil (login, cambio clave, CRUD Menu_Perfil)
class CalificarLib {

	function __construct() {
		$this->CI = & get_instance(); // Esto para acceder a la instancia que carga la librería

                $this->CI->load->model('Model_Calificar');
		
    }

   
    public function my_validation($registro) {
        $this->CI->db->where('bibliografia_id', $registro['bibliografia_id']);
        $this->CI->db->where('contenido_id', $registro['contenido_id']);
        $this->CI->db->where('usuario_id', $registro['usuario_id']);
        $this->CI->db->where('asignatura_id', $registro['asignatura_id']);
        $this->CI->db->where('plan_estudio_id', $registro['plan_estudio_id']);
        
        $query = $this->CI->db->get('calificar');
        
        if ($query->num_rows() > 0 AND (!isset($registro['id']) OR ($registro['id'] != $query->row('id')))) {
            return FALSE;
        }
        else {
            return TRUE;
        }
    }

    public function dar_acceso($contenido_id, $bibliografia_id, $asignatura_id, $plan_estudio_id, $usuario_id) {
        $registro = array();
        $registro['bibliografia_id'] = $bibliografia_id;
        $registro['contenido_id'] = $contenido_id;
        $registro['asignatura_id'] = $asignatura_id;
        $registro['plan_estudio_id'] = $plan_estudio_id;
        $registro['usuario_id'] = $usuario_id;

        
        
        $this->CI->Model_Calificar->insert($registro);
    }
    
      
    public function quitar_acceso($contenido_id, $bibliografia_id, $asignatura_id, $plan_estudio_id, $usuario_id) {
        $this->CI->db->where('contenido_id', $contenido_id);
        $this->CI->db->where('bibliografia_id', $bibliografia_id);
        $this->CI->db->where('asignatura_id', $asignatura_id);
        $this->CI->db->where('plan_estudio_id', $plan_estudio_id);
        $this->CI->db->where('usuario_id', $usuario_id);
        $this->CI->db->delete('calificar');
    }


    public function findByMenuAndPerfil($bibliografia_id, $contenido_id, $asignatura_id, $plan_estudio_id, $usuario_id) {
        $this->CI->db->where('bibliografia_id', $bibliografia_id);
        $this->CI->db->where('contenido_id', $contenido_id);
        $this->CI->db->where('asignatura_id', $asignatura_id);
        $this->CI->db->where('plan_estudio_id', $plan_estudio_id);
        $this->CI->db->where('usuario_id', $usuario_id);

        return $this->CI->db->get('calificar')->row();
    }

}
