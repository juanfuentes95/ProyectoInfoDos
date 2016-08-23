<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Usuarios extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper("url_helper");
		$this->load->helper("url");
		$this->load->model("Usuarios_Model");
		$this->load->library("session");
	}
	public function index(){
		$this->load->view('login/head');
		$this->load->view('login/body');
	}
	public function validar_usuario(){
		//Validar Administrador
		$auxiliar['rut']=$this->input->post('input_rut');
		$auxiliar['pass']=$this->input->post('input_pass');
		while(1){
			$datos['respuesta_db']=$this->Usuarios_Model->consultar_administrador($auxiliar);
			if($datos['respuesta_db']!=false){
				$rut=null;
				$nombre=null;
				$pass=null;
				$bandera=0;
				foreach ($datos['respuesta_db']->result() as $atributo) {
					$rut=$atributo->rut_administrador;
					$nombre=$atributo->nombre_administrador;
					$pass=$atributo->contrasena;
					if ($auxiliar['rut']=$rut && $auxiliar['pass']=$pass && !empty($auxiliar['rut'])) {
						$cookie['rut']=$rut;
						$cookie['nombre']=$nombre;
						$cookie['rol']='ADMINISTRADOR';
						$bandera=1;
						$this->session->set_userdata($cookie);
						$this->load->view('login/acceso/head');
						$this->load->view('login/acceso/body');
						header("Refresh:2 ;url='".base_url()."index.php/principalAdministrador' ");
						break;
					}
				}
				if ($bandera==1) {
					break;
				}
			}else{
				echo "Error contactando a la base de datos";
			}
			$datos['respuesta_db']=$this->Usuarios_Model->consultar_alumno($auxiliar);
			if($datos['respuesta_db']!=false){
				$rut=null;
				$nombre=null;
				$pass=null;
				$bandera=0;
				foreach ($datos['respuesta_db']->result() as $atributo) {
					$rut=$atributo->rut_alumno;
					$nombre=$atributo->nombre_alumno;
					$pass=$atributo->contrasena;
					if ($auxiliar['rut']=$rut && $auxiliar['pass']=$pass) {
						$cookie['rut']=$rut;
						$cookie['nombre']=$nombre;
						$cookie['rol']='ALUMNO';
						$bandera=1;
						$this->session->set_userdata($cookie);
						
						$this->load->view('login/acceso/head');
						$this->load->view('login/acceso/body');
						header("Refresh:2 ;url='".base_url()."index.php/principalAlumno' ");
						break;
					}
				}
				if ($bandera==1) {
					break;
				}
			}else{
				echo "Error contactando a la base de datos";
			}

			$datos['respuesta_db']=$this->Usuarios_Model->consultar_profesor($auxiliar);
			if($datos['respuesta_db']!=false){
				$rut=null;
				$nombre=null;
				$pass=null;
				$bandera=0;
				foreach ($datos['respuesta_db']->result() as $atributo) {
					$rut=$atributo->rut_profesor;
					$nombre=$atributo->nombre_profesor;
					$pass=$atributo->contrasena;
					if ($auxiliar['rut']=$rut && $auxiliar['pass']=$pass) {
						$cookie['rut']=$rut;
						$cookie['nombre']=$nombre;
						$cookie['rol']='PROFESOR';
						$bandera=1;
						$this->session->set_userdata($cookie);
						
						$this->load->view('login/acceso/head');
						$this->load->view('login/acceso/body');
						header("Refresh:2 ;url='".base_url()."index.php/principalProfesor' ");
						break;
					}
				}
				if ($bandera==1) {
					break;
				}
			}else{
				echo "Error contactando a la base de datos";
			}
			$datos['respuesta_db']=$this->Usuarios_Model->consultar_apoderado($auxiliar);
			if($datos['respuesta_db']!=false){
				$rut=null;
				$nombre=null;
				$pass=null;
				$bandera=0;
				foreach ($datos['respuesta_db']->result() as $atributo) {
					$rut=$atributo->rut_apoderado;
					$nombre=$atributo->nombre_apoderado;
					$pass=$atributo->contrasena;
					if ($auxiliar['rut']=$rut && $auxiliar['pass']=$pass) {
						$cookie['rut']=$rut;
						$cookie['nombre']=$nombre;
						$cookie['rol']='APODERADO';
						$bandera=1;
						$this->session->set_userdata($cookie);
						
						$this->load->view('login/acceso/head');
						$this->load->view('login/acceso/body');
						header("Refresh:2 ;url='".base_url()."index.php/principalApoderado' ");
						break;
					}
				}
				if ($bandera==1) {
					break;
				}
			}else{
				echo "Error contactando a la base de datos";
			}
			header("Location: ".base_url());
			break;
		}
	}
	public function cerrar_sesion(){
		$this->session->sess_destroy();
		header("Location: ".base_url());
	}
}