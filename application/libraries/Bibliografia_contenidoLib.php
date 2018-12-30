<?php if (!defined('BASEPATH')) exit('No permitir el acceso directo al script');

// Validaciones para el modelo de menu_perfil (login, cambio clave, CRUD Menu_Perfil)
class Bibliografia_contenidoLib {

	function __construct() {
		$this->CI = & get_instance(); // Esto para acceder a la instancia que carga la librería

                $this->CI->load->model('Model_Bibliografia_contenido');
		
    }

   
    public function my_validation($registro) {
        $this->CI->db->where('bibliografia_id', $registro['bibliografia_id']);
        $this->CI->db->where('contenido_id', $registro['contenido_id']);
        $query = $this->CI->db->get('bibliografia_contenido');
        
        if ($query->num_rows() > 0 AND (!isset($registro['id']) OR ($registro['id'] != $query->row('id')))) {
            return FALSE;
        }
        else {
            return TRUE;
        }
    }

    public function dar_acceso($contenido_id, $bibliografia_id) {
        $registro = array();
        $registro['bibliografia_id'] = $bibliografia_id;
        $registro['contenido_id'] = $contenido_id;
        
        $this->CI->Model_Bibliografia_contenido->insert($registro);
    }
    
      
    public function quitar_acceso($contenido_id, $bibliografia_id) {
        $this->CI->db->where('contenido_id', $contenido_id);
        $this->CI->db->where('bibliografia_id', $bibliografia_id);
        $this->CI->db->delete('bibliografia_contenido');
    }


    public function findByMenuAndPerfil($bibliografia_id, $contenido_id) {
        $this->CI->db->where('bibliografia_id', $bibliografia_id);
        $this->CI->db->where('contenido_id', $contenido_id);
        return $this->CI->db->get('bibliografia_contenido')->row();
    }

}
