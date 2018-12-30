<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Buscador extends CI_Controller 
{
 
 public function __construct() 
 {
 
 parent::__construct();
 //cargamos la base de datos, los helpers
 //librerías y el modelo en el constructor
 $this->load->database('default');
 $this->load->helper(array('form','url'));
 $this->load->library('form_validation');
 $this->load->model('model_buscador');
 $this->load->model('model_plan_estudio');
 $this->load->model('model_asignatura');
 $this->load->model('model_calificar');
 $this->load->model('Model_Bibliografia');
 
 $this->form_validation->set_message('required', '%s es obligatorio');
 
 }
 
 public function index()
 {
     $registro = array();
     $registro = $this->input->post();
     //cargar el session
     if ($registro!=null){  
        $this->session->set_userdata($registro);
     }else{
//         $this->session->sess_destroy();
     }
         
   $idplan = $this->uri->segment(3);
   $parametrosplan  = $this->input->post('plan_id');
   var_dump($parametrosplan);
 //pasamos el título y los resultados de la búsqueda a la vista
 //a través del array data
   $aplanes=$this->model_plan_estudio->get_plan();
   $arrayplanes=array();

   foreach ($aplanes as $key => $value) {
       $arrayplanes[$key]=anchor('buscador/index/'.$key,$value);      
   }
   // var_dump($arrayplanes); 
   
 $data = array('titulo' => 'Buscador','planes'=> $aplanes, 
   'resultados' => $this->busqueda(), 'js'=>'onchange="this.form.submit()"' );
//var_dump($data);  'js'=>anchor('buscador/index/1','xx')

 $data ['asignaturas'] =  $this->model_asignatura->get_asignatura($parametrosplan);
//var_dump( $data ['asignaturas']); 
   
 $this->load->view('buscador_view',$data);
 
 }
 
 
 
 
 //aquí es donde hacemos toda la búsqueda del buscador
 public function busqueda()
 {
 
 if($this->input->post('buscar'))
 {
     $parametros  = $this->input->post();
 
   $this->form_validation->set_rules('tema', 'tema');
 
 
 $campos = array('tema');
 
 //envíamos los datos al modelo para hacer la búsqueda
 $resultados = $this->Model_Bibliografia->buscar_bibliografia($parametros);
 
 if($resultados !== FALSE)
 {
 
 return $resultados;
 
 }
 
 }
 
 }
 
 //a través de jquery llenamos el autocompletado
 public function temas()
    {
        //si es una petición ajax y existe una variable post
        //llamada info dejamos pasar
        if($this->input->is_ajax_request() && $this->input->post('info'))
        {
 
            $abuscar = $this->security->xss_clean($this->input->post('info'));
 
          ///$seatch  
            
            $search = $this->model_buscador->buscador_tema($abuscar);
 
            //si search es distinto de false significa que hay resultados
            //y los mostramos con un loop foreach
            if($search !== FALSE)
            {
 
                foreach($search as $fila)
                {
                ?>
 
                    <p><a title="<?php echo $fila->tema ?>" href="" 
                    	onclick="$('.tema').val($(this).attr('title')); ">
                    	<?php echo $fila->tema ?>
                    </a></p>
 
                <?php
                }
 
            //en otro caso decimos que no hay resultados
            }else{
            ?>
 
                <p><?php echo 'No hay resultados' ?></p>
 
            <?php
            }
 
        }
 
    }
    
    public function calificar($id){
                $data['contenido'] = 'buscador/ver';
		$data['titulo'] = 'Bibliografia';
		$data['registro'] = $this->Model_Bibliografia->find($id);
                //sesion
                $parametrobuscar = array('tema'=>$tema = $this->session->userdata('tema'),
                    'plan_id'=>$tema = $this->session->userdata('plan_id'),
                    'asignatura_id'=>$tema = $this->session->userdata('asignatura_id'),
                    'semestre'=>$tema = $this->session->userdata('semestre'));
                ;
 
                $data['parametrobuscar'] = $parametrobuscar;
                //
		$this->load->view('template', $data);       
    }
    
    public function calificado(){
  		$registro = $this->input->post();
                $registro["usuario_id"] = $this->session->userdata('usuario_id');
               
                if($registro["asignatura_id"]=='0'){
                    $registro["asignatura_id"]=null;
                }
                
                unset($registro["titulo"]);
                unset($registro["autor1"]);
                unset($registro["autor2"]);
                unset($registro["volumen"]);
                $id = $registro["bibliografia_id"];
var_dump($registro);                

		$this->form_validation->set_rules('bibliografia_id', 'Bibliografia', 'required');
		if($this->form_validation->run() == FALSE) {
			$this->calificar($id);
		}
		else {
			$this->model_calificar->insert($registro);
			redirect('buscador/index');
		}
                
    }
}