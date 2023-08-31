<?php
	/*== Almacenando datos ==*/
    $product_id_del=limpiar_strings($_GET['product_id_del']);

    /*== Verificando producto ==*/
    $produc_check=conexion();
    $produc_check=$produc_check->query("SELECT * FROM producto WHERE producto_id='$product_id_del'");

    if($produc_check->rowCount()==1){

    	$data=$produc_check->fetch();

    	$produc_delete=conexion();
    	$produc_delete=$produc_delete->prepare("DELETE FROM producto WHERE producto_id=:id");

    	$produc_delete->execute([":id"=>$product_id_del]);

    	if($produc_delete->rowCount()==1){

    		if(is_file("./img/producto/".$data['produc_images'])){
    			chmod("./img/producto/".$data['produc_images'], 0777);
				unlink("./img/producto/".$data['produc_images']);
    		}

	        echo '
	            <div class="notification is-info is-light">
	                <strong>¡PRODUCTO ELIMINADO!</strong><br>
	                Los datos del producto se eliminaron con exito
	            </div>
	        ';
	    }else{
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                No se pudo eliminar el producto, por favor intente nuevamente
	            </div>
	        ';
	    }
	    $produc_delete=null;
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El PRODUCTO que intenta eliminar no existe
            </div>
        ';
    }
    $produc_check=null;