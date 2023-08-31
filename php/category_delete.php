<?php

    $category_id_del=limpiar_strings($_GET['category_id_del']);

    $check_category=conexion();
    $check_category=$check_category->query("SELECT categoria_id FROM categoria WHERE
    categoria_id='$category_id_del'");

    $check_admin=conexion();
    $check_admin=$check_admin->query("SELECT usuario_admin,usuario_admin_pass FROM usuario WHERE usuario_admin='' AND usuario_id='".$_SESSION['id']."'");

    if ($check_category->rowCount()==1){

        $check_produc=conexion();
        $check_produc=$check_produc->query("SELECT categoria_id FROM producto WHERE
        categoria_id='$category_id_del' LIMIT 1");

        if($check_produc && $check_admin->rowCount()<=0) {
            $delete_category=conexion();
            $delete_category=$delete_category->prepare("DELETE FROM categoria WHERE categoria_id=:id");
        
            $delete_category->execute([":id"=>$category_id_del]);
            
        if($delete_category->rowCount()==1){
        
            echo '
            <div class="notification is-info is-light">
                <strong>¡Categoria Eliminada!</strong><br>
                La categoria y sus datos han sido eliminados sastifactoriamente.
            </div>
                ';

            } else {
                    echo '
                        <div class="notification is-danger is-light">
                            <strong>¡Ocurrio un error inesperado!</strong><br>
                            No se pudo eliminar el usuario, por favor, intente nuevamente.
                        </div>
                        ';  
                        }
        
        } else {
               echo '
                    <div class="notification is-danger is-light">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        No podemos eliminar la categoria por dos posibles razones: <br>
                        1) <strong>Usted</strong> no posee privilegios de administrador <br>
                        2) La Categoria <strong>tiene</strong> productos registrados
                    </div>
                    ';
        }

    $check_produc=null;

    } else {
            echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La categoria que intenta eliminar no existe.
            </div>
                ';
            }

    $check_produc=null;

?>