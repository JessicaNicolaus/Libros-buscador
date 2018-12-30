<?php if (!defined('BASEPATH')) exit('No permitir el acceso directo al script');

// Validaciones para el modelo de menu_perfil (login, cambio clave, CRUD Menu_Perfil)
class Asignatura_contenidoLib {

	function __construct() {
		$this->CI = & get_instance(); // Esto para acceder a la instancia que carga la librería

                $this->CI->load->model('Model_Asignatura_contenido');
		
    }

   
    public function my_validation($registro) {
        $this->CI->db->where('asignatura_id', $registro['asignatura_id']);
        $this->CI->db->where('contenido_id', $registro['contenido_id']);
        $query = $this->CI->db->get('asignatura_contenido');
        
        if ($query->num_rows() > 0 AND (!isset($registro['id']) OR ($registro['id'] != $query->row('id')))) {
            return FALSE;
        }
        else {
            return TRUE;
        }
    }

    public function dar_acceso($contenido_id, $asignatura_id) {
        $registro = array();
        $registro['asignatura_id'] = $asignatura_id;
        $registro['contenido_id'] = $contenido_id;
        
        $this->CI->Model_Asignatura_contenido->insert($registro);
    }
    
      
    public function quitar_acceso($contenido_id, $asignatura_id) {
        $this->CI->db->where('contenido_id', $contenido_id);
        $this->CI->db->where('asignatura_id', $asignatura_id);
        $this->CI->db->delete('asignatura_contenido');
    }


    public function findByMenuAndPerfil($asignatura_id, $contenido_id) {
        $this->CI->db->where('asignatura_id', $asignatura_id);
        $this->CI->db->where('contenido_id', $contenido_id);
        return $this->CI->db->get('asignatura_contenido')->row();
    }

}
