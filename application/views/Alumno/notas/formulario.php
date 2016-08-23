<body>

<div class="container col-md-10">
	<!-- El resultado del formulario(filtro) se envía de vuelta al controlador "notas"-->
	<form method="POST" action="<?php echo base_url();?>index.php/principalAlumno/notas">
	  	
	  	<div class="form-group">
	    	<label for="edicion">Edición</label>
			<select class="form-control" name="edicion-post">
				<?php 
				foreach ($edicion1->result() as $atributo1) {
					$anio_curso=$atributo1->anio_curso;
					echo '<option value="'.$anio_curso.'">'.$anio_curso.'</option>';
				}
				?>
			</select>
	  	</div>


	  	<div class="form-group">
	    	<label for="curso">Curso</label>
			<select class="form-control" name="curso-post">
				<?php 
				foreach ($edicion2->result() as $atributo2) {
					$nombre_curso=$atributo2->nombre_curso;
					echo '<option value="'.$nombre_curso.'">'.$nombre_curso.'</option>';
				}
				?>
			</select>
	  	</div>



	  	<div class="form-group">
	    	<label for="asignatura">Asignatura</label>
			<select class="form-control" name="asignatura-post">
				<?php 
				$id_asignatura=null;
				$nombre_asignatura=null;
				foreach ($asignatura->result() as $atributo) {
					$nombre_asignatura=$atributo->nombre_asignatura;
					$id_asignatura=$atributo->id_asignatura;
					echo '<option value="'.$id_asignatura.'">'.$nombre_asignatura.'</option>';
				}
				?>
			</select>
	  	</div>
	  	<div class="form-group">
	    	<label for="xmestre">SEMESTRE O TRIMESTRE</label>
			<select class="form-control" name="xmestre-post">
	  			<option value="1">1</option>
	  			<option value="2">2</option>
	  			<option value="3">3</option>
			</select>
	  	</div>
		<button type="submit" name="submit" class="btn btn-primary">Submit</button>
	</form>
</div>

</body>