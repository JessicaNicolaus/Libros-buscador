<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Plan_estudio extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function all() {
		$query = $this->db->get('plan_estudio');
		return $query->result();
	}

	function allFiltered($field, $value) {
		$this->db->like($field, $value);
		$query = $this->db->get('plan_estudio');
		return $query->result();
	}

	function find($id) {
		$this->db->where('id', $id);
		return $this->db->get('plan_estudio')->row();
	}

	function insert($registro) {
		$this->db->set($registro);
		$this->db->insert('plan_estudio');
	}

	function update($registro) {
		$this->db->set($registro);
		$this->db->where('id', $registro['id']);
		$this->db->update('plan_estudio');
	}

	function delete($id) {
		$this->db->where('id', $id);
		$this->db->delete('plan_estudio');
	}
        
        function get_plan(){
            $lista = array();
            $registros = $this->all();
            foreach ($registros as $registro){
                $lista[$registro->id] = $registro->plan;
            }
            return $lista;
        }
}
