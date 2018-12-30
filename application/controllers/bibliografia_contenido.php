<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bibliografia_contenido extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model('Model_Bibliografia_contenido');
		$this->form_validation->set_message('required', '%s es obligatorio');
	}

	public function index() {
		$data['contenido'] = 'bibliografia_contenido/index';
		$data['titulo'] = 'Pesos';
		$data['query'] = $this->Model_Bibliografia_contenido->all();
		$this->load->view('template', $data);
	}

	public function search() {
		$data['contenido'] = 'bibliografia_contenido/index';
		$data['titulo'] = 'bibliografia';
		$value = $this->input->post('buscar');
		$data['query'] = $this->Model_Bibliografia_contenido->allFiltered('bibliografia_contenido.id_bibliografia', $value);
		$this->load->view('template', $data);
	}

	public function create() {
		$data['contenido'] = 'bibliografia_contenido/create';
		$data['titulo'] = 'b';
		$data['bibliografias'] = $this->Model_Bibliografia_contenido->get_bibliografia();	/* Lista de los  */
		$data['contenidos'] = $this->Model_Bibliografia_contenido->get_contenido();
                //$data['asignaturas'] = $this->Model_Bibliografia_contenido->get_asignatura();
                //$data['planes_estudios'] = $this->Model_Bibliografia_contenido->get_plan_estudio();
		$this->load->view('template', $data);
	}

	public function insert() {
		$registro = $this->input->post();
		$this->form_validation->set_rules('peso', 'Peso', 'required');
		if($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$this->Model_Bibliografia_contenido->insert($registro);
			redirect('bibliografia_contenido/index');
		}
	}

	public function edit($id) {
		$data['contenido'] = 'bibliografia_contenido/edit';
		$data['titulo'] = 'Actualizar';
		$data['registro'] = $this->Model_Bibliografia_contenido->find($id);
		$data['bibliografias'] = $this->Model_Bibliografia_contenido->get_bibliografia(); /* Lista de los  */
		$data['contenidos'] = $this->Model_Bibliografia_contenido->get_contenido();
               // $data['asignaturas'] = $this->Model_Bibliografia_contenido->get_asignatura();
               //$data['planes_estudios'] = $this->Model_Bibliografia_contenido->get_plan_estudio();
		$this->load->view('template', $data);
	}

	public function update() {
		$registro = $this->input->post();
				
		$this->form_validation->set_rules('peso', 'Peso', 'required');
		if($this->form_validation->run() == FALSE) {
			$this->edit($registro['id']);
		}
		else {
			$this->Model_Bibliografia_contenido->update($registro);
			redirect('bibliografia_contenido/index');
		}	
	}

	public function delete($id) {
		$this->Model_Bibliografia_contenido->delete($id);
		redirect('bibliografia_contenido/index');
	}
}
