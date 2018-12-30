<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Calificar extends CI_Model {

    function __construct() {
		parent::__construct();
    }

    function all() {
        $this->db->select('calificar.* , contenido.tema as contenido_tema, bibliografia.titulo as bibliografia_titulo, usuario.name as usuario_name,
            plan_estudio.plan as plan_estudio_plan, asignatura.nombre as asignatura_nombre');
        $this->db->from('calificar');
        $this->db->join('contenido', 'bibliografia_contenido.contenido_id = contenido.id', 'left');
        $this->db->join('bibliografia', 'bibliografia_contenido.bibliografia_id = bibliografia.id', 'left');
        $this->db->join('usuario', 'calificar.usuario_id = usuario.id', 'left');
        $this->db->join('plan_estudio', 'calificar.plan_estudio_id = plan_estudio.id', 'left');
        $this->db->join('asignatura', 'calificar.asignatura_id = asignatura.id', 'left');
        $query = $this->db->get();
        return $query->result();
    }
    
    
    function allFiltered($field, $value) {
         $this->db->select('calificar.* , contenido.tema as contenido_tema, bibliografia.titulo as bibliografia_titulo, usuario.name as usuario_name,
            plan_estudio.plan as plan_estudio_plan, asignatura.nombre as asignatura_nombre');
        $this->db->from('calificar');
        $this->db->join('contenido', 'bibliografia_contenido.contenido_id = contenido.id', 'left');
        $this->db->join('bibliografia', 'bibliografia_contenido.bibliografia_id = bibliografia.id', 'left');
        $this->db->join('usuario', 'calificar.usuario_id = usuario.id', 'left');
        $this->db->join('plan_estudio', 'calificar.plan_estudio_id = plan_estudio.id', 'left');
        $this->db->join('asignatura', 'calificar.asignatura_id = asignatura.id', 'left');
        $this->db->like($field, $value);
        
        $query = $this->db->get();
        return $query->result();
    }


    function find($id) {
    	$this->db->where('id', $id);
		return $this->db->get('calificar')->row();
                
    }

    function insert($registro) {
    	$this->db->set($registro);
		$this->db->insert('calificar');
    }

    function update($registro) {
    	$this->db->set($registro);
		$this->db->where('id', $registro['id']);
		$this->db->update('calificar');
    }

    function delete($id) {
    	$this->db->where('id', $id);
		$this->db->delete('calificar');
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
    
    function get_asignaturas() {
        $lista = array();
        $this->load->model('Model_Asignatura');
        $registros = $this->Model_Asignatura->all();
        foreach ($registros as $registro) {
            $lista[$registro->id] = $registro->nombre;
        }
        return $lista;
    }
    
    function get_usuario() {
        $lista = array();
        $this->load->model('Model_Usuario');
        $registros = $this->Model_Usuario->all();
        foreach ($registros as $registro) {
            $lista[$registro->id] = $registro->name;
        }
        return $lista;
    }
    
    function get_plan_estudio() {
        $lista = array();
        $this->load->model('Model_Plan_estudio');
        $registros = $this->Model_Plan_estudio->all();
        foreach ($registros as $registro) {
            $lista[$registro->id] = $registro->plan;
        }
        return $lista;
    }
    
    

}




