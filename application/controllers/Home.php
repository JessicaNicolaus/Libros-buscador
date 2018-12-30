<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	//constructor de clase
	function __construct(){
		parent::__construct();

		$this->load->library('usuarioLib');
                
                $this->load->model('Model_Usuario');
                
                $this->form_validation->set_message('required','%s es campo obligatorio');
                $this->form_validation->set_message('loginok','Usuario o clave incorrectos');
                $this->form_validation->set_message('matches', '%s no coincide con %s');
                $this->form_validation->set_message('cambiook', 'No se puede realizar el cambio de clave');

	}
	

	//pagina inicio
	public function index()
	{
		$data['contenido'] = "home/index";
		$data['titulo'] = "Inicio";
		$this->load->view('template', $data);
	}
	
	//llama presentacion acerca de
	public function acerca_de()
	{
		$data['contenido'] = "home/acerca_de";
		$data['titulo'] = "Acerca de";
		$this->load->view('templatelibros', $data);
	}
	
	//llama a la presentacion ingreso
	public function ingreso(){
		$data['contenido'] = "home/ingreso";
		$data['titulo'] = "Ingreso";
		$this->load->view('template', $data);
	}
	
	//realiza la operacion ingresar
	public function ingresar(){
		//campos del formulario
		$login    = $this->input->post('login');
		$password = $this->input->post('password');
		//realizar validacion
		$this->form_validation->set_rules('login','Usuario', 'required|callback_loginok');
		$this->form_validation->set_rules('password','Clave', 'required');
                
		//comprobar
		if($this->form_validation->run() == FALSE){
			$this->ingreso();
		}else{
			//redireccionar a pagina de inicio
			redirect('home/index');
		}
	}
	
           
	public function loginok() {
		$login = $this->input->post('login');
		$password = $this->input->post('password');
                
                return $this->usuariolib->login($login, md5($password));	

	}
        
	//llama al acceso denegado
	public function acceso_denegado()
	{
		$data['contenido'] = "home/acceso_denegado";
		$data['titulo'] = "Acceso Negado";
		$this->load->view('template', $data);
	}
	
	//realiza la operacion de salir
	public function salir(){
		$this->session->sess_destroy();
		redirect('home/index');
	}
                
        public function cambio_clave() {
		$data['contenido'] = 'home/cambio_clave';
		$data['titulo'] = 'Cambiar Clave';
		$this->load->view('template', $data);
	}
        public function libros() {
		$data['contenido'] = 'templatelibros';
		$data['titulo'] = 'Datos libros';
		$this->load->view('templatelibros', $data);
	}
        
        public function cambiar_clave() {
		$this->form_validation->set_rules('clave_act', 'Clave Actual', 'required|callback_cambiook');
		$this->form_validation->set_rules('clave_new', 'Clave Nueva', 'required|matches[clave_rep]');
		$this->form_validation->set_rules('clave_rep', 'Repita Nueva', 'required');
		if($this->form_validation->run() == FALSE) {
			$this->cambio_clave();
		}
		else {
                    //recuperar el usuario autenticado
                    $id = $this->session->userdata('usuario_id');
                    $new = $this->input->post('clave_new');
                    
                    //cambiar clave
                    $data = array('id' => $id,
                       'password' => md5($new));
                    $this->Model_Usuario->update($data);
                
                    redirect('home/index');
		}
	}

                
        public function cambiook() {
		$act = $this->input->post('clave_act');
		$new = $this->input->post('clave_new');
		return $this->usuariolib->cambiarPWD(md5($act), md5($new));
	}
        
   
}
