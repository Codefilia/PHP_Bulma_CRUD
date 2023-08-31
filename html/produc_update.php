<div class="container is-fluid mb-6">
	<h1 class="title">Productos</h1>
	<h2 class="subtitle">Actualizar producto</h2>
</div>

<div class="container pb-6 pt-6">
	<?php
		include "./inc/btn_back.php";

		require_once "./php/main.php";

		$id = (isset($_GET['product_id_up'])) ? $_GET['product_id_up'] : 0;
		$id=limpiar_strings($id);

		/*== Verificando producto ==*/
    	$produc_check=conexion();
    	$produc_check=$produc_check->query("SELECT * FROM producto WHERE producto_id='$id'");

        if($produc_check->rowCount()>0){
        	$data=$produc_check->fetch();
	?>

	<div class="form-rest mb-6 mt-6"></div>
	
	<h2 class="title has-text-centered"><?php echo $data['produc_nombre']; ?></h2>

	<form action="./php/produc_data_updated.php" method="POST" class="FormularioAjax" autocomplete="off" >

		<input type="hidden" name="producto_id" value="<?php echo $data['producto_id']; ?>" required >

		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Código de barra</label>
				  	<input class="input" type="text" name="producto_codigo" pattern="[a-zA-Z0-9- ]{1,70}" maxlength="70" required value="<?php echo $data['produc_codigo']; ?>" >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Nombre</label>
				  	<input class="input" type="text" name="producto_nombre" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}" maxlength="70" required value="<?php echo $data['produc_nombre']; ?>" >
				</div>
		  	</div>
		</div>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Precio</label>
				  	<input class="input" type="text" name="producto_precio" pattern="[0-9.]{1,25}" maxlength="25" required value="<?php echo $data['produc_precio']; ?>" >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Stock</label>
				  	<input class="input" type="text" name="producto_stock" pattern="[0-9]{1,25}" maxlength="25" required value="<?php echo $data['produc_stock']; ?>" >
				</div>
		  	</div>
		  	<div class="column">
				<label>Categoría</label><br>
		    	<div class="select is-rounded">
				  	<select name="producto_categoria" >
				    	<?php
    						$category=conexion();
    						$category=$category->query("SELECT * FROM categoria");
    						if($category->rowCount()>0){
    							$category=$category->fetchAll();
    							foreach($category as $row){
    								if($data['categoria_id']==$row['categoria_id']){
    									echo '<option value="'.$row['categoria_id'].'" selected="" >'.$row['cat_nombre'].' (Actual)</option>';
    								}else{
    									echo '<option value="'.$row['categoria_id'].'" >'.$row['cat_nombre'].'</option>';
    								}
				    			}
				   			}
				   			$category=null;
				    	?>
				  	</select>
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
		$produc_check=null;
	?>
</div>