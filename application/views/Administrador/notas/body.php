<body>
	

	
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

				$query = $this->Administrador_Model->consultar_notas($id_registro);
				foreach ($query->result() as $value) {
					$aux=$value->codigo_nota;
					echo "<th><input type='text' class='form-control' name='nota-".$aux."' value='".$value->nota."'></th>";
				}
				echo "<input style='display:none;' type='text' name='valor_maximo' value='".$aux."'>";
				echo "</tr>";
			}
			?>
	  	</tbody>
	</table>
	<button type="submit" class="btn btn-primary">Submit</button>
</form>

</body>