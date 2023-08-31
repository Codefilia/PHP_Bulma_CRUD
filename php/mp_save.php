<?php
	require_once "../inc/session_start.php";

	require_once "main.php";

	/*== Almacenando datos ==*/
	$nombre=limpiar_strings($_POST['mp_nombre']);
	$stock=limpiar_strings($_POST['mp_stock']);
	
	/*== Verificando campos obligatorios ==*/
    if($nombre=="" || $stock==""){
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
    $check_nombre=conexion();
    $check_nombre=$check_nombre->query("SELECT materia_nombre FROM materia WHERE materia_nombre='$nombre'");
    if($check_nombre->rowCount()>0){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El <strong>NOMBRE</strong> ingresado ya se encuentra registrado, por favor elija otro
            </div>
        ';
        exit();
    }
    $check_nombre=null;
    
    /*== Guardando datos ==*/
    $mp_save=conexion();
    $mp_save=$mp_save->prepare("INSERT INTO materia(materia_nombre,materia_stock) VALUES(:nombre,:stock)");

    $marcadores=[
        ":nombre"=>$nombre,
        ":stock"=>$stock
        ];
        
    $mp_save->execute($marcadores);
    
     if($mp_save->rowCount()==1){
        echo '
            <div class="notification is-info is-light">
                <strong>¡PRODUCTO REGISTRADO!</strong><br>
               La materia prima se registro con exito
            </div>
        ';
         
     } else {    
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo registrar el producto, por favor intente nuevamente
            </div>
        ';
    }
        









	
?>

