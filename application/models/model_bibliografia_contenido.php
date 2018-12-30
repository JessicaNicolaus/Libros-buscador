<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Bibliografia_contenido extends CI_Model {

    function __construct() {
		parent::__construct();
    }

    function all() {
        $this->db->select('bibliografia_contenido.* , contenido.tema as contenido_tema, bibliografia.titulo as bibliografia_titulo');
        $this->db->from('bibliografia_contenido');
        $this->db->join('contenido', 'bibliografia_contenido.contenido_id = contenido.id', 'left');
        $this->db->join('bibliografia', 'bibliografia_contenido.bibliografia_id = bibliografia.id', 'left');
        $query = $this->db->get();
        return $query->result();
    }
    
    
    function allFiltered($field, $value) {
        $this->db->select('bibliografia_contenido.* ,contenido.tema as contenido_tema, bibliografia.titulo as bibliografia_titulo');
        $this->db->from('bibliografia_contenido');
        $this->db->join('contenido', 'bibliografia_contenido.contenido_id = contenido.id', 'left');
        $this->db->join('bibliografia', 'bibliografia_contenido.bibliografia_id = bibliografia.id', 'left');
        $this->db->like($field, $value);
        
        $query = $this->db->get();
        return $query->result();
    }


    function find($id) {
    	$this->db->where('id', $id);
		return $this->db->get('bibliografia_contenido')->row();
                
    }

    function insert($registro) {
    	$this->db->set($registro);
		$this->db->insert('bibliografia_contenido');
    }

    function update($registro) {
    	$this->db->set($registro);
		$this->db->where('id', $registro['id']);
		$this->db->update('bibliografia_contenido');
    }

    function delete($id) {
    	$this->db->where('id', $id);
		$this->db->delete('bibliografia_contenido');
    }

    
    function get_bibliografias() {
        $lista = array();
        $this->load->model('Model_Bibliografia');
        $registros = $this->Model_Bibliografia->all();
        foreach ($registros as $registro) {
            $lista[$registro->id] = $registro->titulo;
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

