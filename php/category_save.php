<?php
	require_once "main.php";

    /*== Almacenando datos ==*/
    $cat_nombre=limpiar_strings($_POST['categoria_nombre']);
    $ubicacion=limpiar_strings($_POST['categoria_ubicacion']);

    /*== Verificando campos obligatorios ==*/
    if($cat_nombre==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }

    /*== Verificando integridad de los datos ==*/
    if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}",$cat_nombre)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El <strong>NOMBRE</strong> no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if($ubicacion!=""){
    	if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{5,150}",$ubicacion)){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                La <strong>UBICACION</strong> no coincide con el formato solicitado
	            </div>
	        ';
	        exit();
	    }
    }

    /*== Verificando nombre ==*/
    $check_cat_nombre=conexion();
    $check_cat_nombre=$check_cat_nombre->query("SELECT cat_nombre FROM categoria 
    WHERE cat_nombre='$cat_nombre'");
    if($check_cat_nombre->rowCount()>0){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El <strong>NOMBRE</strong> de la categoria ingresado ya se encuentra registrado, por favor elija otro
            </div>
        ';
        exit();
    }
    $check_cat_nombre=null;

    /*== Guardando datos ==*/
    $save_category=conexion();
    $save_category=$save_category->prepare("INSERT INTO categoria(cat_nombre,cat_ubicacion) 
    VALUES(:nombre,:ubicacion)");

    $marcadores=[
        ":nombre"=>$cat_nombre,
        ":ubicacion"=>$ubicacion
    ];

    $save_category->execute($marcadores);

    if($save_category->rowCount()==1){
        echo '
            <div class="notification is-info is-light">
                <strong>¡CATEGORIA REGISTRADA!</strong><br>
                La categoría se registro con exito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo registrar la categoría, por favor intente nuevamente
            </div>
        ';
    }

    $save_category=null;