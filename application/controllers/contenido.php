<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contenido extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model('Model_Contenido');
		$this->load->library('contenidoLib');
		$this->form_validation->set_message('required', '%s es obligatorio');
                $this->form_validation->set_message('norep', 'Existe otro registro con el mismo nombre');

	}

	public function index() {
		$data['contenido'] = 'contenido/index';
		$data['titulo'] = 'Temas';
		$data['query'] = $this->Model_Contenido->all();
		$this->load->view('template', $data);
	}

	public function search() {
		$data['contenido'] = 'contenido/index';
		$data['titulo'] = 'Temas';
		$value = $this->input->post('buscar');
		$data['query'] = $this->Model_Contenido->allFiltered('tema', $value);
		$this->load->view('template', $data);
	}

	public function norep() {
		return $this->contenidolib->norep($this->input->post());
	}

	public function create() {
		$data['contenido'] = 'contenido/create';
		$data['titulo'] = 'Crear tema';
		$this->load->view('template', $data);
	}
	public function insert() {
		$registro = $this->input->post();

		$this->form_validation->set_rules('tema', 'Tema', 'required|callback_norep');
		if($this->form_validation->run() == FALSE) {
			$this->create();
		}
		else {
			$this->Model_Contenido->insert($registro);
			redirect('contenido/index');
		}
	}

	public function edit($id) {
		$data['contenido'] = 'contenido/edit';
		$data['titulo'] = 'Actualizar tema';
		$data['registro'] = $this->Model_Contenido->find($id);
		$this->load->view('template', $data);
	}

	public function update() {
		$registro = $this->input->post();
				
		$this->form_validation->set_rules('tema', 'Tema', 'required|callback_norep');
		if($this->form_validation->run() == FALSE) {
			$this->edit($registro['id']);
		}
		else {
			$this->Model_Contenido->update($registro);
			redirect('contenido/index');
		}	
	}

	public function delete($id) {
		$this->Model_Contenido->delete($id);
		redirect('contenido/index');
	}
}
