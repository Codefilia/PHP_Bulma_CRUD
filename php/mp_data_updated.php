<?php
	require_once "main.php";

	/*== Almacenando id ==*/
    $id=limpiar_strings($_POST['materia_id']);


    /*== Verificando categoria ==*/
	$mp_check=conexion();
	$mp_check=$mp_check->query("SELECT * FROM materia WHERE materia_id='$id'");

    if($mp_check->rowCount()<=0){
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La materia prima no existe en el sistema
            </div>
        ';
        exit();
    }else{
    	$datos=$mp_check->fetch();
    }
    $mp_check=null;

    /*== Almacenando datos ==*/
    $nombre=limpiar_strings($_POST['mp_nombre']);
    $stock=limpiar_strings($_POST['mp_stock']);


    /*== Verificando campos obligatorios ==*/
    if($nombre==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }
    
    if($stock<0){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }

     /*== Verificando integridad de los datos ==*/
     if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,$#\-\/ ]{1,70}",$nombre)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El<strong>NOMBRE</strong> no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if(verificar_datos("[0-9]{1,25}",$stock)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El <strong>STOCK</strong> no coincide con el formato solicitado
            </div>
        ';
        exit();
    }


    /*== Verificando nombre ==*/
    if($nombre!=$datos['materia_nombre']){
	    $check_nombre=conexion();
	    $check_nombre=$check_nombre->query("SELECT materia_nombre FROM materia WHERE materia_nombre='$nombre'");
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


    /*== Actualizar datos ==*/
    $actualizar_materia=conexion();
    $actualizar_materia=$actualizar_materia->prepare("UPDATE materia SET materia_nombre=:nombre,materia_stock=:stock
    WHERE materia_id=:id");

    $marcadores=[
        ":nombre"=>$nombre,
        ":stock"=>$stock,
        ":id"=>$id
    ];

    if($actualizar_materia->execute($marcadores)){
        echo '
            <div class="notification is-info is-light">
                <strong>¡MATERIA PRIMA ACTUALIZADA!</strong><br>
                La materia prima se actualizo con exito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo actualizar la materia prima, por favor intente nuevamente
            </div>
        ';
    }
    $actualizar_materia=null;

    $mp_check=null;

?>
