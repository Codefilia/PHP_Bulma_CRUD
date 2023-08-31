<?php
    require_once "main.php";

	/*== Almacenando datos ==*/
    $product_id=limpiar_strings($_POST['img_up_id']);

    /*== Verificando producto ==*/
    $produc_check=conexion();
    $produc_check=$produc_check->query("SELECT * FROM producto WHERE producto_id='$product_id'");

    if($produc_check->rowCount()==1){
        $data=$produc_check->fetch();
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La imagen del PRODUCTO que intenta actualizar no existe
            </div>
        ';
        exit();
    }
    $produc_check=null;


    /*== Comprobando si se ha seleccionado una imagen ==*/
    if($_FILES['producto_foto']['name']=="" || $_FILES['producto_foto']['size']==0){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No ha seleccionado ninguna imagen o foto
            </div>
        ';
        exit();
    }


    /* Directorios de imagenes */
    $img_dir='../img/producto/';


    /* Creando directorio de imagenes */
    if(!file_exists($img_dir)){
        if(!mkdir($img_dir,0777)){
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    Error al crear el directorio de imagenes
                </div>
            ';
            exit();
        }
    }


    /* Cambiando permisos al directorio */
    chmod($img_dir, 0777);


    /* Comprobando formato de las imagenes */
    if(mime_content_type($_FILES['producto_foto']['tmp_name'])!="image/jpeg" && mime_content_type($_FILES['producto_foto']['tmp_name'])!="image/png"){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La imagen que ha seleccionado es de un formato que no está permitido
            </div>
        ';
        exit();
    }


    /* Comprobando que la imagen no supere el peso permitido */
    if(($_FILES['producto_foto']['size']/1024)>3072){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La imagen que ha seleccionado supera el límite de peso permitido
            </div>
        ';
        exit();
    }


    /* extencion de las imagenes */
    switch(mime_content_type($_FILES['producto_foto']['tmp_name'])){
        case 'image/jpeg':
          $img_ext=".jpg";
        break;
        case 'image/png':
          $img_ext=".png";
        break;
    }

    /* Nombre de la imagen */
    $img_name=renombrar_fotos($data['produc_nombre']);

    /* Nombre final de la imagen */
    $photo=$img_name.$img_ext;

    /* Moviendo imagen al directorio */
    if(!move_uploaded_file($_FILES['producto_foto']['tmp_name'], $img_dir.$photo)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No podemos subir la imagen al sistema en este momento, por favor intente nuevamente
            </div>
        ';
        exit();
    }


    /* Eliminando la imagen anterior */
    if(is_file($img_dir.$data['produc_images']) && $data['produc_images']!=$photo){

        chmod($img_dir.$data['produc_images'], 0777);
        unlink($img_dir.$data['produc_images']);
    }


    /*== Actualizando datos ==*/
    $produc_update=conexion();
    $produc_update=$produc_update->prepare("UPDATE producto SET produc_images=:foto WHERE producto_id=:id");

    $marcadores=[
        ":foto"=>$photo,
        ":id"=>$product_id
    ];

    if($produc_update->execute($marcadores)){
         echo '
            <div class="notification is-info is-light">
                <strong>¡IMAGEN O FOTO ELIMINADA!</strong><br>
                La imagen del producto ha sido eliminada exitosamente, pulse "Regresar atrás" para recargar los cambios
            </div>
        ';
    }else{

        if(is_file($img_dir.$photo)){
            chmod($img_dir.$photo, 0777);
            unlink($img_dir.$photo);
        }

        echo '
            <div class="notification is-warning is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No podemos subir la imagen al sistema en este momento, por favor intente nuevamente
            </div>
        ';
    }
    $produc_update=null;