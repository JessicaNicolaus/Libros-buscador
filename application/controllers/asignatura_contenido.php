<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asignatura_contenido extends CI_Controller {

	// Constructor de Clase
	function __construct() {
		parent::__construct();

		$this->load->model('Model_Asignatura_contenido');
                $this->load->library('asignatura_contenidoLib');

                $this->form_validation->set_message('my_validation', 'Existe otro registro con esa combinación');
		
	}

	public function index() {
		$data['contenido'] = 'asignatura_contenido/index';
		$data['titulo'] = 'asignaturas';
		$data['query'] = $this->Model_Asignatura_contenido->all();
		$this->load->view('template', $data);
	}

	public function search() {
		$data['contenido'] = 'asignatura_contenido/index';
		$data['titulo'] = 'asignaturas';
		$value = $this->input->post('buscar');
		$data['query'] = $this->Model_Asignatura_contenido->allFiltered('asignatura.nombre', $value);
		$this->load->view('template', $data);
	}
                  
	public function my_validation() {
		return $this->asignatura_contenidolib->my_validation($this->input->post());
	}
            
        public function create() {
		$data['contenido'] = 'asignatura_contenido/create';
		$data['titulo'] = 'Crear contenido_asignatura';
                $data['asignaturas'] = $this->Model_Asignatura_contenido->get_asignaturas(); 
                $data['contenidos'] = $this->Model_Asignatura_contenido->get_contenidos(); /* Lista de los Perfiles */
                
		$this->load->view('template', $data);
	}
        
	public function insert() {
		$registro = $this->input->post();

		$this->form_validation->set_rules('id', 'ID', 'callback_my_validation');
		if($this->form_validation->run() == FALSE) {
			$this->create();
		}
		else {
                        
			$this->Model_Asignatura_contenido->insert($registro);
			redirect('asignatura_contenido/index');
		}
	}
        
               
	public function edit($id) {
		$data['contenido'] = 'asignatura_contenido/edit';
		$data['titulo'] = 'Actualizar asignatura_contenido';
		$data['registro'] = $this->Model_Asignatura_contenido->find($id);
                $data['contenidos'] = $this->Model_Asignatura_contenido->get_contenidos(); /* Lista de los Perfiles */
                $data['asignaturas'] = $this->Model_Asignatura_contenido->get_asignaturas(); 
		$this->load->view('template', $data);
	}
        
        public function update() {
		$registro = $this->input->post();
                
                $this->form_validation->set_rules('id', 'ID', 'callback_my_validation');
                if($this->form_validation->run() == FALSE) {
			$this->edit($registro['id']);
		}
                else {
			
			$this->Model_Asignatura_contenido->update($registro);
			redirect('asignatura_contenido/index');
		}    
        }
        
        public function delete($id) {
		$this->Model_Asignatura_contenido->delete($id);
		redirect('asignatura_contenido/index');
	}

        	

}
