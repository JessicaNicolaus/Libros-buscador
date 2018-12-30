<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_buscador extends CI_Model
{
	
	public function __construct()
	{
		
		parent::__construct();
		
	}
	
	//hacemos la búsqueda de las poblaciones en el 
	//evento keyup de jquery
	public function buscador_tema($abuscar)
    {
        //usamos after para decir que empiece a buscar por
        //el principio de la cadena
        //ej SELECT poblacion from poblacion
        //WHERE poblacion LIKE '%$abuscar' limit 12
        $this->db->select('contenido');
 
        $this->db->like('contenido',$abuscar,'after');
 
        $resultados = $this->db->get('contenido', 12);
 
        //si existe algún resultado lo devolvemos
        if($resultados->num_rows() > 0)
        {
 
            return $resultados->result();
 
        //en otro caso devolvemos false
        }else{
 
            return FALSE;
 
        }
 
    }
	
	//hacemos la consulta a la base de datos para
	//mostrar los datos de nuestro buscador
	public function nueva_busqueda($campos)
	{
		
		//definimos si descripción viene vacio o no para utilizar el operador and or
		$and_or = $this->input->post('descripcion') != '' ? ' AND ' : ' OR ';
			
		$condiciones = array();
		
		//recorremos los campos del formulario
		foreach($campos as $campo){
			
			//si llegan las variables y no están vacias
			if($this->input->post($campo) && $this->input->post($campo) != '') 
			{
				
			    //definimos la condición para hacer la búsqueda de los campos y de 
			    //esta forma podemos hacer uso del array condiciones fuera del loop
			    $condiciones[] = "$campo LIKE '%" . $this->input->post($campo) . "%'";
				
	        }
			
		}
			
		//la consulta base a la que concatenaremos la búsqueda
		$sql = "SELECT * FROM bibliografia_contenido ";
		
		//si existen condiciones entramos
		if(count($condiciones) > 0) 
		{
			
		    //aquí creamos la condición y la concatenamos a $sql
		    $sql .= "WHERE " . implode ($and_or, $condiciones);
			
		}

		//asignamos a $query la consulta final
		$query = $this->db->query($sql);
		
		//con la siguiente línea podéis ver lo que arroja la 
		//consulta escogiendo varios campos, es bueno entenderlo
		//var_dump($sql); exit;
		
		//si se ha encontrado algo 
		if($query->num_rows() > 0)
		{
				
			return $query->result();
				
		}else{
			
			return FALSE;
			
		}
		
	}
	
}
/*
* end application/models/buscador_model.php
*/