<?php if (!defined('BASEPATH')) exit('No permitir el acceso directo al script');

// Validaciones para el modelo de menu_perfil (login, cambio clave, CRUD Menu_Perfil)
class AsignaturaLib {

	function __construct() {
		$this->CI = & get_instance(); // Esto para acceder a la instancia que carga la librería

                $this->CI->load->model('Model_Asignatura');
		
    }

   
    public function my_validation($registro) {
        $this->CI->db->where('plan_estudio_id', $registro['plan_estudio_id']);
        
        $query = $this->CI->db->get('asignatura');
        
        if ($query->num_rows() > 0 AND (!isset($registro['id']) OR ($registro['id'] != $query->row('id')))) {
            return FALSE;
        }
        else {
            return TRUE;
        }
    }

    public function dar_acceso($plan_estudio_id) {
        $registro = array();
        $registro['plan_estudio_id'] = $plan_estudio_id;
       
        
        $this->CI->Model_Asignatura->insert($registro);
    }
    
      
    public function quitar_acceso($plan_estudio_id) {
        $this->CI->db->where('plan_estudio_id', $plan_estudio_id);
        
        $this->CI->db->delete('asignatura');
    }


   /* public function findByMenuAndPerfil($plan_estudio_id) {
        $this->CI->db->where('plan_estudio_id', $plan_estudio_id);
      
        return $this->CI->db->get('asignatura')->row();
    }*/

    public function get_contenidos_asig_noasig($asignatura_id) {
        $lista_asig = array();
        $lista_noasig = array();
      
        $this->CI->load->model('Model_Contenido');
        $contenidos = $this->CI->Model_Contenido->all();  
     
        foreach($contenidos as $contenido) {
            $this->CI->db->where('asignatura_id', $asignatura_id);
            $this->CI->db->where('contenido_id', $contenido->id);            
            $query = $this->CI->db->get('asignatura_contenido');
            $lista_asignatura_contenido = $query->result();
            
            $existe = (count($lista_asignatura_contenido) > 0);

            if($existe) {
                $lista_asig[] = array($contenido->id, $contenido->tema, $asignatura_id);
            }else{
                $lista_noasig[] = array($contenido->id, $contenido->tema, $asignatura_id);
            }
  
        }
        
        return array($lista_noasig, $lista_asig);
        
    }

    
    public function findByNombre($nombre) {
        $this->CI->db->where('nombre', $nombre);
        return $this->CI->db->get('asignatura')->row();
    }

}
