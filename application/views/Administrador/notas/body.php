<body>

<!--Tabla con los datos, cuando se cambian las notas, se envían los datos a "actualizar_basedatos" en el controlador PrincipalAdministrador-->
<div class="container col-md-10">
	<form method="POST" action="<?php echo base_url();?>index.php/principaladministrador/actualizar_basedatos">
		<table class="table">
		  	<thead>
			    <tr>
			      	<th>#</th>
			      	<th>First Name</th>
			      	<th>Last Name</th>
			      	<th>Notas</th>
			    </tr>
		  	</thead>
		  	<tbody>
		  		<!-- Se imprimen en html todos los alumnos que pertenecen a tal edición, de tal asignatura, de tal semestre-->
		      	<?php 
		      	$id_registro=null;
		      	$rut_alumno=null;
		      	$i=1;
				foreach ($registro->result() as $atributo) {
					$id_registro=$atributo->id_registro;
					$rut_alumno=$atributo->rut_alumno;
					echo "<tr>";
					echo "<th scope='row'>".$i."</th>";
					echo "<td>".$id_registro."</td>";
					echo "<td>".$rut_alumno."</td>";
					$i=$i+1;

					//Como solo tenemos en la tabla los rut de los alumnos, ahora necesitamos sus notas, por lo que vamos a consultar sus notas con el identificador de registro(cada alumno, que pertenece a tal edición de un curso, con tal asignatura, de tal semestre, tiene un identificador de registro -id_registro- único)
					$query = $this->Administrador_Model->consultar_notas($id_registro);
					foreach ($query->result() as $value) {
						$aux=$value->codigo_nota;
						echo "<th><input type='text' class='form-control' name='nota-".$aux."' value='".$value->nota."'></th>";
					}
					echo "<input style='display:none;' type='text' name='valor_maximo' value='".$aux."'>";
					echo "</tr>";
					//por lo tanto, todas las notas serán enviadas con el tag="nota-x", el valor máximo se refiere al "x" máximo que se ocupará para actualizar la base de datos
				}
				?>
		  	</tbody>
		</table>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>

</div>

</body>