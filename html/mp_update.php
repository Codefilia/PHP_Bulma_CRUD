<div class="container is-fluid mb-6">
	<h1 class="title">Materia Prima</h1>
	<h2 class="subtitle">Actualizar materia prima</h2>
</div>

<div class="container pb-6 pt-6">
	<?php
		include "./inc/btn_back.php";

		require_once "./php/main.php";

		$id = (isset($_GET['mp_id_up'])) ? $_GET['mp_id_up'] : 0;
		$id=limpiar_strings($id);

		/*== Verificando categoria ==*/
    	$check_materia=conexion();
    	$check_materia=$check_materia->query("SELECT * FROM materia WHERE materia_id='$id'");

        if($check_materia->rowCount()>0){
        	$datos=$check_materia->fetch();
	?>

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/mp_data_updated.php" method="POST" class="FormularioAjax" autocomplete="off" >

		<input type="hidden" name="materia_id" value="<?php echo $datos['materia_id']; ?>" required >

		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Nombre</label>
				  	<input class="input" type="text" name="mp_nombre" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}" maxlength="50" required value="<?php echo $datos['materia_nombre']; ?>" >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Kilogramos o Litros</label>
				  	<input class="input" type="text" name="mp_stock" pattern="[0-9]{1,25}" maxlength="25" required value="<?php echo $datos['materia_stock']; ?>" >
				</div>
		  	</div>
		</div>
		<p class="has-text-centered">
			<button type="submit" class="button is-success is-rounded">Actualizar</button>
		</p>
	</form>
	<?php 
		}else{
			include "./inc/error_alert.php";
		}
		$check_materia=null;
	?>
</div>