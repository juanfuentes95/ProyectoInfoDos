<?php
class Administrador_Model extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	

	//Consulta todos los cursos de la base de datos
	public function Consultar_Curso(){
		$consulta="SELECT id_curso,nombre_curso FROM curso";
		$respuesta=$this->db->query($consulta);
		return $respuesta;
	}

	//Consulta todas las ediciones de la base de datos
	public function Consultar_Edicion(){
		$consulta="SELECT anio_curso FROM edicion";
		$respuesta=$this->db->query($consulta);
		return $respuesta;
	}

	//Consulta todas las asignaturas de la base de datos
	public function Consultar_Asignatura(){
		$consulta="SELECT id_asignatura,nombre_asignatura FROM asignatura";
		$respuesta=$this->db->query($consulta);
		return $respuesta;
	}

	
	//nos devuelve el ID de la edición, a partir del Curso y Año Edición, que en el filtro venían por separado
	public function Consultar_Edicion_post($arreglo){
		$consulta="	SELECT id_edicion FROM edicion 
					WHERE id_curso=".$arreglo['curso']." 
					AND anio_curso=".$arreglo['edicion'];
		$respuesta=$this->db->query($consulta);
		return $respuesta;
	}

	//nos devuelve las tuplas de alumnos que tienen tal asignatura, de tal edición
	//y de tal semestre. Serán varios alumnos, todos compañeros
	public function Consultar_Registro($arreglo){
		$consulta="	SELECT id_registro, rut_alumno FROM registro 
					WHERE
					id_edicion=".$arreglo['aux']." AND
					id_asignatura=".$arreglo['asignatura']." AND
					x_mestre=".$arreglo['xmestre'];
		$respuesta=$this->db->query($consulta);
		return $respuesta;
	}


	public function consultar_notas($id_registro){
		$consulta="SELECT * FROM notas WHERE id_registro=".$id_registro;
		$respuesta=$this->db->query($consulta);
		return $respuesta;
	}

	public function actualizar_notas($arreglo){
		$consulta="UPDATE notas set nota=".$arreglo['nota']." WHERE codigo_nota=".$arreglo['codigo_nota'];
		$respuesta=$this->db->query($consulta);
	}
}
