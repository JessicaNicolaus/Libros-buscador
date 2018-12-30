<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Asignatura extends CI_Model {

    function __construct() {
		parent::__construct();
    }

    function all() {
        $this->db->select('asignatura.* , plan_estudio.plan as plan_estudio_plan');
        $this->db->from('asignatura');
        $this->db->join('plan_estudio', 'asignatura.plan_estudio_id = plan_estudio.id', 'left');
        $query = $this->db->get();
        return $query->result();
    }
    
      function all_orden($orden) {
        $this->db->select('asignatura.* , plan_estudio.plan as plan_estudio_plan');
        $this->db->from('asignatura');
        $this->db->join('plan_estudio', 'asignatura.plan_estudio_id = plan_estudio.id', 'left');
        $this->db->order_by($orden, "asc");
        $query = $this->db->get();
        return $query->result();
    }
    
    
    function allFiltered($field, $value) {
        $this->db->select('asignatura.* , plan_estudio.plan as plan_estudio_plan');
        $this->db->from('asignatura');
        $this->db->join('plan_estudio', 'asignatura.plan_estudio_id = plan_estudio.id', 'left');
        $this->db->like($field, $value);
        
        $query = $this->db->get();
        return $query->result();
    }


    function find($id) {
    	$this->db->where('id', $id);
		return $this->db->get('asignatura')->row();
    }

    function insert($registro) {
    	$this->db->set($registro);
		$this->db->insert('asignatura');
    }

    function update($registro) {
    	$this->db->set($registro);
		$this->db->where('id', $registro['id']);
		$this->db->update('asignatura');
    }

    function delete($id) {
    	$this->db->where('id', $id);
		$this->db->delete('asignatura');
    }

    
    function get_planes() {
        $lista = array();
        $this->load->model('Model_Plan_estudio');
        $registros = $this->Model_Plan_estudio->all();
        foreach ($registros as $registro) {
            $lista[$registro->id] = $registro->plan;
        }
        return $lista;
    }
    
    
   function get_asignatura($id){
            $lista = array();
            $registros = $this->all_orden("nombre");
            $lista[0] = "Todos";
            foreach ($registros as $registro){
                if (!$id){
                $lista[$registro->id] = $registro->nombre.', '.$registro->plan_estudio_plan;
                }
                else {
                    if ($id==$registro->plan_estudio_id){
                        $lista[$registro->id] = $registro->nombre.', '.$registro->plan_estudio_plan;
                    }
                }
            }
            return $lista;
        }
        

}

