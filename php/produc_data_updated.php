<?php
	require_once "main.php";

	/*== Almacenando id ==*/
    $id=limpiar_strings($_POST['producto_id']);


    /*== Verificando producto ==*/
	$check_producto=conexion();
	$check_producto=$check_producto->query("SELECT * FROM producto WHERE producto_id='$id'");

    if($check_producto->rowCount()<=0){
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El producto no existe en el sistema
            </div>
        ';
        exit();
    }else{
    	$datos=$check_producto->fetch();
    }
    $check_producto=null;


    /*== Almacenando datos ==*/
    $codigo=limpiar_strings($_POST['producto_codigo']);
	$nombre=limpiar_strings($_POST['producto_nombre']);

	$precio=limpiar_strings($_POST['producto_precio']);
	$stock=limpiar_strings($_POST['producto_stock']);
	$categoria=limpiar_strings($_POST['producto_categoria']);


	/*== Verificando campos obligatorios ==*/
    if($codigo=="" || $nombre=="" || $precio=="" || $stock=="" || $categoria==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }


    /*== Verificando integridad de los datos ==*/
    if(verificar_datos("[a-zA-Z0-9- ]{1,70}",$codigo)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El CODIGO de BARRAS no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}",$nombre)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El NOMBRE no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[0-9.]{1,25}",$precio)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El PRECIO no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[0-9]{1,25}",$stock)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El STOCK no coincide con el formato solicitado
            </div>
        ';
        exit();
    }


    /*== Verificando codigo ==*/
    if($codigo!=$datos['produc_codigo']){
	    $check_codigo=conexion();
	    $check_codigo=$check_codigo->query("SELECT produc_codigo FROM producto WHERE produc_codigo='$codigo'");
	    if($check_codigo->rowCount()>0){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                El CODIGO de BARRAS ingresado ya se encuentra registrado, por favor elija otro
	            </div>
	        ';
	        exit();
	    }
	    $check_codigo=null;
    }


    /*== Verificando nombre ==*/
    if($nombre!=$datos['produc_nombre']){
	    $check_nombre=conexion();
	    $check_nombre=$check_nombre->query("SELECT produc_nombre FROM producto WHERE produc_nombre='$nombre'");
	    if($check_nombre->rowCount()>0){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                El NOMBRE ingresado ya se encuentra registrado, por favor elija otro
	            </div>
	        ';
	        exit();
	    }
	    $check_nombre=null;
    }


    /*== Verificando categoria ==*/
    if($categoria!=$datos['categoria_id']){
	    $category_check=conexion();
	    $category_check=$category_check->query("SELECT categoria_id FROM categoria WHERE categoria_id='$categoria'");
	    if($category_check->rowCount()<=0){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                La categoría seleccionada no existe
	            </div>
	        ';
	        exit();
	    }
	    $category_check=null;
    }


    /*== Actualizando datos ==*/
    $produc_update=conexion();
    $produc_update=$produc_update->prepare("UPDATE producto SET produc_codigo=:codigo,
    produc_nombre=:nombre,produc_precio=:precio,produc_stock=:stock,categoria_id=:categoria 
    WHERE producto_id=:id");

    $inputs=[
        ":codigo"=>$codigo,
        ":nombre"=>$nombre,
        ":precio"=>$precio,
        ":stock"=>$stock,
        ":categoria"=>$categoria,
        ":id"=>$id
    ];


    if($produc_update->execute($inputs)){
        echo '
            <div class="notification is-info is-light">
                <strong>¡PRODUCTO ACTUALIZADO!</strong><br>
                El producto se actualizo con exito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo actualizar el producto, por favor intente nuevamente
            </div>
        ';
    }
    $produc_update=null;