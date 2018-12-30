<?php if (!defined('BASEPATH')) exit('No permitir el acceso directo al script');

class BibliografiaLib {
	function __construct() {
		$this->CI = & get_instance();
		$this->CI->load->model('Model_Bibliografia');
	}

	public function norep($registro) {
		$this->CI->db->where('titulo', $registro['titulo']);
		$query = $this->CI->db->get('bibliografia');

		if ($query->num_rows() > 0 AND (!isset($registro['id']) OR ($registro['id'] != $query->row('id')))) {
			return FALSE;
		} else {
			return TRUE;
		}
	}
        
        
         public function get_contenidos_asig_noasig($bibliografia_id) {
        $lista_asig = array();
        $lista_noasig = array();
      
        $this->CI->load->model('Model_Contenido');
        $contenidos = $this->CI->Model_Contenido->all();  
     
        foreach($contenidos as $contenido) {
            $this->CI->db->where('bibliografia_id', $bibliografia_id);
            $this->CI->db->where('contenido_id', $contenido->id);            
            $query = $this->CI->db->get('bibliografia_contenido');
            $lista_bibliografia_contenido = $query->result();
            
            $existe = (count($lista_bibliografia_contenido) > 0);

            if($existe) {
                $lista_asig[] = array($contenido->id, $contenido->tema, $bibliografia_id);
            }else{
                $lista_noasig[] = array($contenido->id, $contenido->tema, $bibliografia_id);
            }
  
        }
        
        return array($lista_noasig, $lista_asig);
        
    }

    
    public function findByNombre($nombre) {
        $this->CI->db->where('nombre', $nombre);
        return $this->CI->db->get('bibliografia')->row();
    }
}
