<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asignatura extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Model_Asignatura');
		$this->load->library('asignaturaLib');
		$this->form_validation->set_message('required', '%s es obligatorio');
		//$this->form_validation->set_message('norep', 'Existe otro registro con el mismo nombre');
	}

	public function index() {
		$data['contenido'] = 'asignatura/index';
		$data['titulo'] = 'Asignaturas';
		$data['query'] = $this->Model_Asignatura->all();
		$this->load->view('template', $data);
	}

	public function search() {
		$data['contenido'] = 'asignatura/index';
		$data['titulo'] = 'Asignaturas';
		$value = $this->input->post('buscar');
		$data['query'] = $this->Model_Asignatura->allFiltered('nombre', $value);
		$this->load->view('template', $data);
	}

	public function norep() {
		return $this->asignaturalib->norep($this->input->post());
	}

	public function create() {
		$data['contenido'] = 'asignatura/create';
		$data['titulo'] = 'Crear asignatura';
                $data['planes'] = $this->Model_Asignatura->get_planes();
		$this->load->view('template', $data);
	}

	public function insert() {
		$registro = $this->input->post();
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		if($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$this->Model_Asignatura->insert($registro);
			redirect('asignatura/index');
		}
	}

	public function edit($id) {
		$data['contenido'] = 'asignatura/edit';
		$data['titulo'] = 'Actualizar asignatura';
		$data['registro'] = $this->Model_Asignatura->find($id);
                $data['planes'] = $this->Model_Asignatura->get_planes();
		$this->load->view('template', $data);
	}

	public function update() {
		$registro = $this->input->post();
				
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		if($this->form_validation->run() == FALSE) {
			$this->edit($registro['id']);
		} else {
			$this->Model_Asignatura->update($registro);
			redirect('asignatura/index');
		}
	}

	public function delete($id) {
		$this->Model_Asignatura->delete($id);
		redirect('asignatura/index');
	}
       
        public function asignatura_contenidos($asignatura_id) {
		$data['contenido'] = 'asignatura/asignatura_contenidos';
		$data['titulo'] = 'Accesos de '.$this->Model_Asignatura->find($asignatura_id)->nombre;
                
                // Cargar arreglos Izquierda y Derecha
                $contenidos = $this->asignaturalib->get_contenidos_asig_noasig($asignatura_id);
		$data['query_izq'] = $contenidos[0];
		$data['query_der'] = $contenidos[1];                  

		$this->load->view('template', $data);
	}
        
                
	public function mp_noasig() {
            $contenido_id = $this->uri->segment(3);
            $asignatura_id = $this->uri->segment(4);
            
            $this->load->library('asignatura_contenidoLib');
            $this->asignatura_contenidolib->quitar_acceso($contenido_id, $asignatura_id);
            redirect('asignatura/asignatura_contenidos/'.$asignatura_id);
        }        
	       
	public function mp_asig() {
            $contenido_id = $this->uri->segment(3);
            $asignatura_id = $this->uri->segment(4);
            
            $this->load->library('asignatura_contenidoLib');
            $this->asignatura_contenidolib->dar_acceso($contenido_id, $asignatura_id);
            redirect('asignatura/asignatura_contenidos/'.$asignatura_id);
        }        
	
}

