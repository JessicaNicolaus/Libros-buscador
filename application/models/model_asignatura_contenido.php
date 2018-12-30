<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Asignatura_contenido extends CI_Model {

    function __construct() {
		parent::__construct();
    }

    function all() {
        $this->db->select('asignatura_contenido.* , contenido.tema as contenido_tema, asignatura.nombre as asignatura_nombre');
        $this->db->from('asignatura_contenido');
        $this->db->join('contenido', 'asignatura_contenido.contenido_id = contenido.id', 'left');
        $this->db->join('asignatura', 'asignatura_contenido.asignatura_id = asignatura.id', 'left');
       // $this->db->join('asignatura', 'asignatura_contenido.asignatura_id = asignatura.id', 'left');
        $query = $this->db->get();
        return $query->result();
    }
    
    
    function allFiltered($field, $value) {
        $this->db->select('asignatura_contenido.* ,contenido.tema as contenido_tema, asignatura.nombre as asignatura_nombre');
        $this->db->from('asignatura_contenido');
        $this->db->join('contenido', 'asignatura_contenido.contenido_id = contenido.id', 'left');
        $this->db->join('asignatura', 'asignatura_contenido.asignatura_id = asignatura.id', 'left');
        $this->db->like($field, $value);
        
        $query = $this->db->get();
        return $query->result();
    }


    function find($id) {
    	$this->db->where('id', $id);
		return $this->db->get('asignatura_contenido')->row();
    }

    function insert($registro) {
    	$this->db->set($registro);
		$this->db->insert('asignatura_contenido');
    }

    function update($registro) {
    	$this->db->set($registro);
		$this->db->where('id', $registro['id']);
		$this->db->update('asignatura_contenido');
    }

    function delete($id) {
    	$this->db->where('id', $id);
		$this->db->delete('asignatura_contenido');
    }

    
    function get_asignaturas() {
        $lista = array();
        $this->load->model('Model_Asignatura');
        $registros = $this->Model_Asignatura->all();
        foreach ($registros as $registro) {
            $lista[$registro->id] = $registro->nombre;
        }
        return $lista;
    }

        
    function get_contenidos() {
        $lista = array();
        $this->load->model('Model_Contenido');
        $registros = $this->Model_Contenido->all();
        foreach ($registros as $registro) {
            $lista[$registro->id] = $registro->tema;
        }
        return $lista;
    }   
        

}

