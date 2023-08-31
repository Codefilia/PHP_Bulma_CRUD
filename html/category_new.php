<div class="container is-fluid mb-6">
	<h1 class="title">Categorías</h1>
	<h2 class="subtitle">Nueva categoría</h2>
</div>

<div class="container pb-6 pt-6">

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/category_save.php" method="POST" class="FormularioAjax" autocomplete="off" >
		<div class="columns">
		  	<div class="column">
			  <div class="control">
					<!-- Caja de Nombres -->
					<label>Nombre</label>
					<p class="control has-icons-left has-icons-right">
				  	<input class="input" type="text" name="categoria_nombre" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}" maxlength="50" required 
					  placeholder="Ej: Primera Categoria">
					  <span class="icon is-small is-left">
					  <i class="fa-regular fa-signature"></i>
				</div>	
		  	</div>
		  	<div class="column">
			  <label>Ubicación</label>
					<p class="control has-icons-left has-icons-right">
				  	<input class="input" type="text" name="categoria_ubicacion" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{5,150}" maxlength="150"  
					  placeholder="Ej: Inventario">
					  <span class="icon is-small is-left">
					  <i class="fa-solid fa-location-dot"></i>
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