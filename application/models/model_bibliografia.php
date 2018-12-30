<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Bibliografia extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function all() {
		$query = $this->db->get('bibliografia');
		return $query->result();
	}

	function allFiltered($field, $value) {
		$this->db->like($field, $value);
		$query = $this->db->get('bibliografia');
		return $query->result();
	}

	function find($id) {
		$this->db->where('id', $id);
		return $this->db->get('bibliografia')->row();
	}

	function insert($registro) {
		$this->db->set($registro);
		$this->db->insert('bibliografia');
	}

	function update($registro) {
		$this->db->set($registro);
		$this->db->where('id', $registro['id']);
		$this->db->update('bibliografia');
	}

	function delete($id) {
		$this->db->where('id', $id);
		$this->db->delete('bibliografia');
	}
        
        function buscar_bibliografia ($parametros){
            
            $this->db->select('bibliografia.*');
            $this->db->from('bibliografia');
            $this->db->join('bibliografia_contenido','bibliografia.id=bibliografia_contenido.bibliografia_id', 'left');
            $this->db->join('contenido','bibliografia_contenido.contenido_id=contenido.id', 'left');
            $this->db->join('asignatura_contenido','contenido.id=asignatura_contenido.contenido_id', 'left');
            $this->db->join('asignatura','asignatura_contenido.asignatura_id=asignatura.id','left');
            
            
            //$this->db->where('id', $id);
            if ($parametros["tema"]){
                
                 $this->db->like('contenido.tema', $parametros["tema"]);
                
            }
            
            if ($parametros["asignatura_id"]){
                $this->db->where('asignatura.id', $parametros["asignatura_id"]);
            }
            
            if ($parametros["plan_id"]){
                $this->db->where('asignatura.plan_estudio_id', $parametros["plan_id"]);
            }
            
            if ($parametros["semestre"]){
                 $this->db->where('asignatura.semestre', $parametros["semestre"]);
            }
            
            $this->db->group_by('id, titulo, autor1, autor2, volumen'); 
            $this->db->order_by("bibliografia.titulo", "asc"); 
                $query = $this->db->get();
//var_dump($query->result());
                           
		return $query->result();
        }
}
