<?php
class Usuarios_Model extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	public function consultar_administrador($arreglo){
		$consulta="SELECT * FROM administrador WHERE
					rut_administrador='".$arreglo['rut']."' AND
					contrasena='".$arreglo['pass']."'";
		$respuesta=$this->db->query($consulta);
		if($respuesta) return $respuesta;
		else return FALSE;
	}
	public function consultar_alumno($arreglo){
		$consulta="SELECT * FROM alumno WHERE
					rut_alumno='".$arreglo['rut']."' AND
					contrasena='".$arreglo['pass']."'";
		$respuesta=$this->db->query($consulta);
		if($respuesta) return $respuesta;
		else return FALSE;
	}
	public function consultar_profesor($arreglo){
		$consulta="SELECT * FROM profesor WHERE
					rut_profesor='".$arreglo['rut']."' AND
					contrasena='".$arreglo['pass']."'";
		$respuesta=$this->db->query($consulta);
		if($respuesta) return $respuesta;
		else return FALSE;
	}
	public function consultar_apoderado($arreglo){
		$consulta="SELECT * FROM apoderado WHERE
					rut_apoderado='".$arreglo['rut']."' AND
					contrasena='".$arreglo['pass']."'";
		$respuesta=$this->db->query($consulta);
		if($respuesta) return $respuesta;
		else return FALSE;
	}
	
}