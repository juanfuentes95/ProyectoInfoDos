<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PrincipalAdministrador extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper("url_helper");
		$this->load->helper("url");
		$this->load->library("session");	
		$this->load->model("Administrador_Model");
		$this->load->library('Grocery_CRUD');
		$this->load->model("Grocery_crud_model"); 
	}

	public function index()
	{
		$this->load->view('administrador/head');
		$this->load->view('administrador/header');
		$this->load->view('administrador/aside');
		$this->load->view('administrador/body');
	}

	//Se ocupó grocery crud simple, solo para mostrar las tablas, después se verá si es necesario hacerlas a mano o dejarlas así :)
	public function curso(){
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('curso');
		$crud->set_subject('Cursos');
		$output=$crud->render();

		$this->load->view('administrador/load_gc/head',$output);
		$this->load->view('administrador/header');
		$this->load->view('administrador/aside');
		$this->load->view('administrador/load_gc/body',$output);
	}

	public function edicion(){
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('edicion');
		$crud->set_subject('Edicion');
		$output=$crud->render();

		$this->load->view('administrador/load_gc/head',$output);
		$this->load->view('administrador/header');
		$this->load->view('administrador/aside');
		$this->load->view('administrador/load_gc/body',$output);
	}

	public function alumno(){
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('alumno');
		$crud->set_subject('Alumnos');
		$output=$crud->render();

		$this->load->view('administrador/load_gc/head',$output);
		$this->load->view('administrador/header');
		$this->load->view('administrador/aside');
		$this->load->view('administrador/load_gc/body',$output);
	}
	public function profesor(){
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('profesor');
		$crud->set_subject('Profesores');
		$output=$crud->render();

		$this->load->view('administrador/load_gc/head',$output);
		$this->load->view('administrador/header');
		$this->load->view('administrador/aside');
		$this->load->view('administrador/load_gc/body',$output);
	}

	public function asignatura(){
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('asignatura');
		$crud->set_subject('Asignaturas');
		$output=$crud->render();

		$this->load->view('administrador/load_gc/head',$output);
		$this->load->view('administrador/header');
		$this->load->view('administrador/aside');
		$this->load->view('administrador/load_gc/body',$output);
	}

	public function registro(){
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('registro');
		$crud->set_subject('Registros');
		$output=$crud->render();

		$this->load->view('administrador/load_gc/head',$output);
		$this->load->view('administrador/header');
		$this->load->view('administrador/aside');
		$this->load->view('administrador/load_gc/body',$output);
	}
	//Aquí termina el grocery crud simple, lo siguiente se hizo a mano

	//Este es el primer paso, el formulario permite al usuario filtrar la búsqueda
	//Se filtra por el curso, edición, asignatura, y semestre/trimestre.
	public function formulario_notas(){
		$resultado['curso']=$this->Administrador_Model->Consultar_Curso();
		$resultado['edicion']=$this->Administrador_Model->Consultar_Edicion();
		$resultado['asignatura']=$this->Administrador_Model->Consultar_Asignatura();

		$this->load->view('administrador/head');
		$this->load->view('administrador/header');
		$this->load->view('administrador/aside');
		$this->load->view('administrador/notas/formulario',$resultado);
	}

	//Luego de envíar el formulario para el filtro, los resultados del envío se
	//capturan en la función "notas".
	public function notas(){

		//Resultado del formulario
		$resultado['curso']=$this->input->post('curso-post');
		$resultado['edicion']=$this->input->post('edicion-post');
		$resultado['asignatura']=$this->input->post('asignatura-post');
		$resultado['xmestre']=$this->input->post('xmestre-post');

		//Como tenemos curso y edición por separado, necesitamos el id de la edición
		//Por qué?, porque una edición se compone de "curso+anio_curso",
		//y la edición es la que está en la tabla "registro".
		$resultado['edicion_post']=$this->Administrador_Model->Consultar_Edicion_post($resultado);

		//capturamos el id de la edición obtenido anteriormente.Siempre es una tupla!
		$id_edicion=null;
		foreach ($resultado['edicion_post']->result() as $atributo) {
			$id_edicion=$atributo->id_edicion;
		}
		//se guarda en el arreglo principal
		$resultado['aux']=$id_edicion;

		//ahora con todos los datos(id_edicion,id_asignatura,x_mestre) se hace la consulta
		//en la tabla Registro
		$resultado['registro']=$this->Administrador_Model->Consultar_Registro($resultado);


		$this->load->view('administrador/head');
		$this->load->view('administrador/header');
		$this->load->view('administrador/aside');
		$this->load->view('administrador/notas/body',$resultado);
	

	}

	public function actualizar_basedatos(){
		//Al llegar los "notas-x", no sabemos hasta que "x" llega, por lo que ese valor será el que tenga la variable $valor_maximo
		$valor_maximo=$this->input->post('valor_maximo');

		//como el valor de "x" coincide con el valor de la variable &i, se tomará el valor de la última variable como el código de la nota(toda nota tiene un código único)
		for ($i=1; $i <= $valor_maximo; $i++) { 
			if ( $this->input->post('nota-'.$i) != null ) {
				$aux=$this->input->post('nota-'.$i);
				$arreglo['codigo_nota']=$i;
				$arreglo['nota']=$aux;
				$this->Administrador_Model->actualizar_notas($arreglo);
			}
		}
		//Luego de actualizar, se redirecciona a la página principal
		header( "Refresh:0; url=".base_url());

	}
}
