<?php
	require_once "main.php";

	/*== Almacenando datos ==*/
    $product_id=limpiar_strings($_POST['img_del_id']);

    /*== Verificando producto ==*/
    $produc_check=conexion();
    $produc_check=$produc_check->query("SELECT * FROM producto WHERE producto_id='$product_id'");

    if($produc_check->rowCount()==1){
    	$datos=$produc_check->fetch();
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La imagen del PRODUCTO que intenta eliminar no existe
            </div>
        ';
        exit();
    }
    $produc_check=null;


    /* Directorios de imagenes */
	$img_dir='../img/producto/';

	/* Cambiando permisos al directorio */
	chmod($img_dir, 0777);


	/* Eliminando la imagen */
	if(is_file($img_dir.$datos['produc_images'])){

		chmod($img_dir.$datos['produc_images'], 0777);

		if(!unlink($img_dir.$datos['produc_images'])){
			echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                Error al intentar eliminar la imagen del producto, por favor intente nuevamente
	            </div>
	        ';
	        exit();
		}
	}


	/*== Actualizando datos ==*/
    $produc_update=conexion();
    $produc_update=$produc_update->prepare("UPDATE producto SET produc_images=:foto WHERE producto_id=:id");

    $inputs=[
        ":foto"=>"",
        ":id"=>$product_id
    ];

    if($produc_update->execute($inputs)){
        echo '
            <div class="notification is-info is-light">
                <strong>¡IMAGEN O FOTO ELIMINADA!</strong><br>
                La imagen del producto ha sido eliminada exitosamente, pulse "Regresar atrás" para recargar los cambios
            </div>
        ';
    }else{
        echo '
            <div class="notification is-warning is-light">
                <strong>¡IMAGEN O FOTO ELIMINADA!</strong><br>
                Ocurrieron algunos inconvenientes, sin embargo la imagen del producto ha sido eliminada, pulse "Regresar atrás" para recargar los cambios.
                <p class="has-text-centered pt-5 pb-5">
                </p">
            </div>
        ';
    }
    $produc_update=null;