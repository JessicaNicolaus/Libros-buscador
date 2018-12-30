<?php if (!defined('BASEPATH')) exit('No permitir el acceso directo al script');

class ContenidoLib {
	function __construct() {
		$this->CI = & get_instance();
		$this->CI->load->model('Model_Contenido');	
	}

	public function norep($registro) {
		$this->CI->db->where('tema', $registro['tema']);
		$query = $this->CI->db->get('contenido');

		if ($query->num_rows() > 0 AND (!isset($registro['id']) OR ($registro['id'] != $query->row('id')))) {
			return FALSE;
		} else {
			return TRUE;
		}
	}
}
