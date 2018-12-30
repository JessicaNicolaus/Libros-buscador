<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plan_estudio extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model('Model_Plan_estudio');
		$this->load->library('plan_estudioLib');
		$this->form_validation->set_message('required', '%s es obligatorio');
		$this->form_validation->set_message('norep', 'Este plan ya está registrado');
	}

	public function index() {
		$data['contenido'] = 'plan_estudio/index';
		$data['titulo'] = 'Plan_estudio';
		$data['query'] = $this->Model_Plan_estudio->all();
		$this->load->view('template', $data);
	}

	public function search() {
		$data['contenido'] = 'plan_estudio/index';
		$data['titulo'] = 'Plan_estudio';
		$value = $this->input->post('buscar');
		$data['query'] = $this->Model_Plan_estudio->allFiltered('plan', $value);
		$this->load->view('template', $data);
	}

	public function norep() {
		return $this->plan_estudiolib->norep($this->input->post());
	}

	public function create() {
		$data['contenido'] = 'plan_estudio/create';
		$data['titulo'] = 'Crear Plan_estudio';
		$this->load->view('template', $data);
	}

	public function insert() {
		$registro = $this->input->post();

		$this->form_validation->set_rules('plan', 'Plan', 'required|callback_norep');
		if($this->form_validation->run() == FALSE) {
			$this->create();
		}
		else {
			$this->Model_Plan_estudio->insert($registro);
			redirect('plan_estudio/index');
		}
	}

	public function edit($id) {
		$data['contenido'] = 'plan_estudio/edit';
		$data['titulo'] = 'Actualizar Plan_estudio';
		$data['registro'] = $this->Model_Plan_estudio->find($id);
		$this->load->view('template', $data);
	}

	public function update() {
		$registro = $this->input->post();
				
		$this->form_validation->set_rules('plan', 'Plan', 'required|callback_norep');
		if($this->form_validation->run() == FALSE) {
			$this->edit($registro['id']);
		}
		else {
			$this->Model_Plan_estudio->update($registro);
			redirect('plan_estudio/index');
		}	
	}

	public function delete($id) {
		$this->Model_Plan_estudio->delete($id);
		redirect('plan_estudio/index');
	}
}

