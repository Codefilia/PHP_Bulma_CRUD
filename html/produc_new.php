<div class="container is-fluid mb-6">
	<h1 class="title">Productos</h1>
	<h2 class="subtitle">Nuevo producto</h2>
</div>

<div class="container pb-6 pt-6">

	<?php
		require_once "./php/main.php";
	?>

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/produc_save.php" method="POST" class="FormularioAjax" autocomplete="off" enctype="multipart/form-data" >
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Código de barra</label>
					<p class="control has-icons-left has-icons-right">
				  	<input class="input" type="text" name="producto_codigo" pattern="[a-zA-Z0-9- ]{1,70}" maxlength="70" required 
					placeholder="Ej: C720">
					<span class="icon is-small is-left">
					<i class="fa-solid fa-barcode"></i>
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Nombre</label>
					<p class="control has-icons-left has-icons-right">
				  	<input class="input" type="text" name="producto_nombre" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}" maxlength="70" required 
					placeholder="Ej: Pan Blanco">
					<span class="icon is-small is-left">
					<i class="fa-regular fa-signature"></i>
				</div>
		  	</div>
		</div>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Precio</label>
					<p class="control has-icons-left has-icons-right">
				  	<input class="input" type="text" name="producto_precio" pattern="[0-9.]{1,25}" maxlength="25" required 
					placeholder="Ej: 25">
					<span class="icon is-small is-left">
					<i class="fa-solid fa-dollar-sign"></i>
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Stock</label>
					<p class="control has-icons-left has-icons-right">
				  	<input class="input" type="text" name="producto_stock" pattern="[0-9]{1,25}" maxlength="25" required 
					placeholder="Ej: 100">
					<span class="icon is-small is-left">
					<i class="fa-solid fa-box"></i>
				</div>
		  	</div>
		  	<div class="column">
				<label>Categoría</label><br>
		    	<div class="select is-rounded">
				  	<select name="producto_categoria" >
				    	<option value="" selected="" >Seleccione una opción</option>
				    	<?php
    						$category=conexion();
    						$category=$category->query("SELECT * FROM categoria");
    						if($category->rowCount()>0){
    							$category=$category->fetchAll();
    							foreach($category as $row){
    								echo '<option value="'.$row['categoria_id'].'" >'.$row['cat_nombre'].'</option>';
				    			}
				   			}
				   			$category=null;
				    	?>
				  	</select>
				</div>
		  	</div>
		</div>
		<div class="columns">
			<div class="column">
				<label>
					Foto o imagen del producto
					<i class="fa-solid fa-image"></i>
				</label><br>
				<div class="file is-small has-name">
				  	<label class="file-label">
				    	<input class="file-input" type="file" name="producto_foto" accept=".jpg, .png, .jpeg" >
				    	<span class="file-cta">
				      		<span class="file-label">Imagen</span>
				    	</span>
				    	<span class="file-name">JPG, JPEG, PNG. (MAX 3MB)</span>
				  	</label>
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
