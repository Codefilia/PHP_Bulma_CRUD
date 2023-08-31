<div class="container is-fluid mb-6">
	<h1 class="title">Materia Prima</h1>
	<h2 class="subtitle">Nueva Materia Prima</h2>
</div>

<div class="container pb-6 pt-6">

	<?php
		require_once "./php/main.php";
	?>

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/mp_save.php" method="POST" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data" >
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Nombre</label>
					<p class="control has-icons-left has-icons-right">
				  	<input class="input" type="text" name="mp_nombre" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}" maxlength="70" required 
					placeholder="Ej: Harina">
					<span class="icon is-small is-left">
					<i class="fa-regular fa-signature"></i>
				</div>
		  	</div>
		</div>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Kilogramos o Litros</label>
					<p class="control has-icons-left has-icons-right">
				  	<input class="input" type="text" name="mp_stock" pattern="[0-9]{1,25}" maxlength="25" required 
					placeholder="Ej: 100">
					<span class="icon is-small is-left">
					<i class="fa-solid fa-box"></i>
				</div>
		  	</div>
		</div>
	
		<p class="has-text-centered">
			
			<button type="submit" class="button is-info is-rounded">
			<span class="icon-text">
				<span class="icon">
				<i class="fa-solid fa-cloud-arrow-up"></i>
				</span>
				<span>Guardar</span></button>
		</p>
	</form>
</div>

<?php
	include "./inc/preloader.php"; 
?>
