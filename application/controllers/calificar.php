<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calificar extends CI_Controller {

	// Constructor de Clase
	function __construct() {
		parent::__construct();

		$this->load->model('Model_Calificar');
                $this->load->library('calificarLib');

                $this->form_validation->set_message('my_validation', 'Existe otro registro con esa combinación');
		
	}

	public function index() {
		$data['contenido'] = 'calificar/index';
		$data['titulo'] = 'calificar';
		$data['query'] = $this->Model_Calificar->all();
		$this->load->view('template', $data);
	}

	public function search() {
		$data['contenido'] = 'calificar/index';
		$data['titulo'] = 'calificar';
		$value = $this->input->post('buscar');
		$data['query'] = $this->Model_Calificar->allFiltered('bibliografia.titulo', $value);
		$this->load->view('template', $data);
	}
                  
	public function my_validation() {
		return $this->calificarlib->my_validation($this->input->post());
	}
            
        public function create() {
		$data['contenido'] = 'calificar/create';
		$data['titulo'] = 'Crear';
                $data['usuario'] = $this->Model_Calificar->get_usuario(); 
                $data['bibliografia'] = $this->Model_Calificar->get_bibliografia(); 
                $data['contenido'] = $this->Model_Calificar->get_contenidos(); 
                $data['plan_estudio'] = $this->Model_Calificar->get_plan_estudio();
                $data['asignatura'] = $this->Model_Calificar->get_asignatura();
                
                
		$this->load->view('template', $data);
	}
        
	public function insert() {
		$registro = $this->input->post();

		$this->form_validation->set_rules('id', 'ID', 'callback_my_validation');
                $this->form_validation->set_rules('calificacion', 'Calificacion', 'required');
		if($this->form_validation->run() == FALSE) {
			$this->create();
		}
		else {
                        
			$this->Model_Calificar->insert($registro);
			redirect('calificar/index');
		}
	}
        
               
	public function edit($id) {
		$data['contenido'] = 'calificar/edit';
		$data['titulo'] = 'Actualizar';
		$data['registro'] = $this->Model_Calificar->find($id);
                $data['usuario'] = $this->Model_Calificar->get_usuario(); 
                $data['bibliografia'] = $this->Model_Calificar->get_bibliografia(); 
                $data['contenido'] = $this->Model_Calificar->get_contenidos(); 
                $data['plan_estudio'] = $this->Model_Calificar->get_plan_estudio();
                $data['asignatura'] = $this->Model_Calificar->get_asignatura();
		$this->load->view('template', $data);
	}
        
        public function update() {
		$registro = $this->input->post();
                
                $this->form_validation->set_rules('id', 'ID', 'callback_my_validation');
                if($this->form_validation->run() == FALSE) {
			$this->edit($registro['id']);
		}
                else {
			
			$this->Model_Calificar->update($registro);
			redirect('calificar/index');
		}    
        }
        
        public function delete($id) {
		$this->Model_Calificar->delete($id);
		redirect('calificar/index');
	}

        	

}
