<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bibliografia extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model('Model_Bibliografia');
		$this->load->library('bibliografiaLib');
		$this->form_validation->set_message('required', '%s es obligatorio');

	}

	public function index() {
		$data['contenido'] = 'bibliografia/index';
		$data['titulo'] = 'Titulo';
		$data['query'] = $this->Model_Bibliografia->all();
		$this->load->view('template', $data);
	}
        
        public function ver($id){
               $data['contenido'] = 'bibliografia/ver';
		$data['titulo'] = 'Bibliografia';
		$data['registro'] = $this->Model_Bibliografia->find($id);
                //sesion
                $parametrobuscar = array('tema'=>$tema = $this->session->userdata('tema'),
                    'plan_id'=>$tema = $this->session->userdata('plan_id'),
                    'asignatura_id'=>$tema = $this->session->userdata('asignatura_id'),
                    'semestre'=>$tema = $this->session->userdata('semestre'));
                              
                //
		$this->load->view('template', $data);
        }

	public function search() {
		$data['contenido'] = 'bibliografia/index';
		$data['titulo'] = 'Titulo';
		$value = $this->input->post('buscar');
		$data['query'] = $this->Model_Bibliografia->allFiltered('titulo', $value);
		$this->load->view('template', $data);
	}

	public function norep() {
		return $this->bibliografialib->norep($this->input->post());
	}

	public function create() {
		$data['contenido'] = 'bibliografia/create';
		$data['titulo'] = 'Crear bibliografia';
		$this->load->view('template', $data);
	}
	public function insert() {
		$registro = $this->input->post();

		$this->form_validation->set_rules('titulo', 'Titulo', 'required');
		if($this->form_validation->run() == FALSE) {
			$this->create();
		}
		else {
			$this->Model_Bibliografia->insert($registro);
			redirect('bibliografia/index');
		}
	}

	public function edit($id) {
		$data['contenido'] = 'bibliografia/edit';
		$data['titulo'] = 'Actualizar bibliografia';
		$data['registro'] = $this->Model_Bibliografia->find($id);
		$this->load->view('template', $data);
	}

	public function update() {
		$registro = $this->input->post();
				
		$this->form_validation->set_rules('titulo', 'Titulo', 'required');
		if($this->form_validation->run() == FALSE) {
			$this->edit($registro['id']);
		}
		else {
			$this->Model_Bibliografia->update($registro);
			redirect('bibliografia/index');
		}	
	}

	public function delete($id) {
		$this->Model_Bibliografia->delete($id);
		redirect('bibliografia/index');
	}
        
        public function bibliografia_contenidos($bibliografia_id) {
		$data['contenido'] = 'bibliografia/bibliografia_contenidos';
		$data['titulo'] = 'Accesos de '.$this->Model_Bibliografia->find($bibliografia_id)->titulo;
                
                // Cargar arreglos Izquierda y Derecha
                $contenidos = $this->bibliografialib->get_contenidos_asig_noasig($bibliografia_id);
		$data['query_izq'] = $contenidos[0];
		$data['query_der'] = $contenidos[1];                  

		$this->load->view('template', $data);
	}
        
                
	public function mp_noasig() {
            $contenido_id = $this->uri->segment(3);
            $bibliografia_id = $this->uri->segment(4);
            
            $this->load->library('bibliografia_contenidoLib');
            $this->bibliografia_contenidolib->quitar_acceso($contenido_id, $bibliografia_id);
            redirect('bibliografia/bibliografia_contenidos/'.$bibliografia_id);
        }        
	       
	public function mp_asig() {
            $contenido_id = $this->uri->segment(3);
            $bibliografia_id = $this->uri->segment(4);
            
            $this->load->library('bibliografia_contenidoLib');
            $this->bibliografia_contenidolib->dar_acceso($contenido_id, $bibliografia_id);
            redirect('bibliografia/bibliografia_contenidos/'.$bibliografia_id);
        }        
}
