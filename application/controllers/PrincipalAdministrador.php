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

	public function formulario_notas(){
		$resultado['curso']=$this->Administrador_Model->Consultar_Curso();
		$resultado['edicion']=$this->Administrador_Model->Consultar_Edicion();
		$resultado['asignatura']=$this->Administrador_Model->Consultar_Asignatura();

		$this->load->view('administrador/head');
		$this->load->view('administrador/header');
		$this->load->view('administrador/aside');
		$this->load->view('administrador/notas/formulario',$resultado);
	}
	public function notas(){

		
		$resultado['curso']=$this->input->post('curso-post');
		$resultado['edicion']=$this->input->post('edicion-post');
		$resultado['asignatura']=$this->input->post('asignatura-post');
		$resultado['xmestre']=$this->input->post('xmestre-post');


		$resultado['edicion_post']=$this->Administrador_Model->Consultar_Edicion_post($resultado);

		$id_edicion=null;
		foreach ($resultado['edicion_post']->result() as $atributo) {
			$id_edicion=$atributo->id_edicion;
		}
		$resultado['aux']=$id_edicion;

		$resultado['registro']=$this->Administrador_Model->Consultar_Registro($resultado);

		$this->load->view('administrador/head');
		$this->load->view('administrador/header');
		$this->load->view('administrador/aside');
		$this->load->view('administrador/notas/body',$resultado);
	

	}

	public function actualizar_basedatos(){
		$valor_maximo=$this->input->post('valor_maximo');
		for ($i=1; $i <= $valor_maximo; $i++) { 
			if ( $this->input->post('nota-'.$i) != null ) {
				$aux=$this->input->post('nota-'.$i);
				$arreglo['codigo_nota']=$i;
				$arreglo['nota']=$aux;
				$this->Administrador_Model->actualizar_notas($arreglo);
			}
		}
		header( "Refresh:0; url=".base_url());

	}
}
