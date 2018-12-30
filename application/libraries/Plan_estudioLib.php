<?php if (!defined('BASEPATH')) exit('No permitir el acceso directo al script');

class Plan_estudioLib {
	function __construct() {
		$this->CI = & get_instance();
		$this->CI->load->model('Model_Plan_estudio');	
	}

	public function norep($registro) {
		$this->CI->db->where('plan', $registro['plan']);
		$query = $this->CI->db->get('plan_estudio');

		if ($query->num_rows() > 0 AND (!isset($registro['id']) OR ($registro['id'] != $query->row('id')))) {
			return FALSE;
		} else {
			return TRUE;
		}
	}
}

