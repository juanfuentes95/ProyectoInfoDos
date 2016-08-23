<body>
	
	<table class="table">
		<thead>
			<tr>
			   	<th>id</th>
			   	<th>asignatura</th>
			   	<th>profesor</th>
				<th>edicion</th>
			</tr>
		</thead>
		<tbody>
		  	<tr>
		  		<?php 

				foreach ($ape->result() as $value) {
					$nombre_asignatura=null;
					$id_curso=null;
					$arreglo['nombre_asignatura']=$this->Apoderado_Model->consultar_nombre_asignatura($value->asignatura);
					foreach ($arreglo['nombre_asignatura']->result() as $value1) {
						$nombre_asignatura=$value1->nombre_asignatura;
					}

					$arreglo['nombre_profesor']=$this->Apoderado_Model->consultar_nombre_profesor($value->profesor);
					foreach ($arreglo['nombre_profesor']->result() as $value2) {
						$nombre_profesor=$value2->nombre_profesor;
					}

					$arreglo['edicion']=$this->Apoderado_Model->consultar_edicion_completo($value->edicion);
					foreach ($arreglo['edicion']->result() as $value3) {
						$id_curso=$value3->id_curso;
						$anio_curso=$value3->anio_curso;
					}

					$arreglo['curso']=$this->Apoderado_Model->consultar_nombre_curso($id_curso);
					foreach ($arreglo['curso']->result() as $value4) {
						$nombre_curso=$value4->nombre_curso;
					}


					echo "<th>".$value->id."</th>";
				   	echo "<th>"."id=".$value->asignatura.$nombre_asignatura."</th>";
				   	echo "<th>"."id=".$value->profesor.$nombre_profesor."</th>";
					echo "<th>"."id=".$value->edicion.$nombre_curso.$anio_curso."</th>";
				}

				?>
			   	
			</tr>		
		</tbody>
	</table>
</body>