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
}
