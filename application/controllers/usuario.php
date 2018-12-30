<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller {

	// Constructor de Clase
	function __construct() {
		parent::__construct();

		$this->load->model('Model_Usuario');
                $this->load->library('usuarioLib');

		$this->form_validation->set_message('required', '%s es obligatorio');
                $this->form_validation->set_message('valid_email', 'Campo %s no es un eMail valido');
                $this->form_validation->set_message('my_validation', 'Existe otro registro con el mismo nombre');
		
	}

	public function index() {
		$data['contenido'] = 'usuario/index';
		$data['titulo'] = 'Usuarios';
		$data['query'] = $this->Model_Usuario->all();
		$this->load->view('template', $data);
	}

	public function search() {
		$data['contenido'] = 'usuario/index';
		$data['titulo'] = 'Usuarios';
		$value = $this->input->post('buscar');
		$data['query'] = $this->Model_Usuario->allFiltered('usuario.name', $value);
		$this->load->view('template', $data);
	}
                  
	public function my_validation() {
		return $this->usuariolib->my_validation($this->input->post());
	}
            
        public function create() {
		$data['contenido'] = 'usuario/create';
		$data['titulo'] = 'Crear Usuario';
                $data['perfiles'] = $this->Model_Usuario->get_perfiles(); /* Lista de los Perfiles */
		$this->load->view('template', $data);
	}
        
	public function insert() {
		$registro = $this->input->post();

		$this->form_validation->set_rules('name', 'Nombre', 'required');
                $this->form_validation->set_rules('login', 'Login', 'required|callback_my_validation');
                $this->form_validation->set_rules('email', 'eMail', 'required|valid_email');
		if($this->form_validation->run() == FALSE) {
			$this->create();
		}
		else {
			$registro['password'] = md5($registro['login']); // Por defecto misma login y pwd
                        $registro['created']  = date('Y/m/d H:i');
			$registro['updated']  = date('Y/m/d H:i');
			$this->Model_Usuario->insert($registro);
			redirect('usuario/index');
		}
	}
        
               
	public function edit($id) {
		$data['contenido'] = 'usuario/edit';
		$data['titulo'] = 'Actualizar Usuario';
		$data['registro'] = $this->Model_Usuario->find($id);
                $data['perfiles'] = $this->Model_Usuario->get_perfiles(); /* Lista de los Perfiles */
		$this->load->view('template', $data);
	}
        
        public function update() {
		$registro = $this->input->post();
                
                $this->form_validation->set_rules('name', 'Nombre', 'required');
                $this->form_validation->set_rules('login', 'Login', 'required|callback_my_validation');
                $this->form_validation->set_rules('email', 'eMail', 'required|valid_email');
                if($this->form_validation->run() == FALSE) {
			$this->edit($registro['id']);
		}
                else {
			$registro['updated'] = date('Y/m/d H:i');
			$this->Model_Usuario->update($registro);
			redirect('usuario/index');
		}    
        }
        
        public function delete($id) {
		$this->Model_Usuario->delete($id);
		redirect('usuario/index');
	}

        	

}
