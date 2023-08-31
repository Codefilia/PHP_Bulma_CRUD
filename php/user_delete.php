<?php
    $user_id_del=limpiar_strings($_GET['user_id_del']);

    /*== Verificando Usuario ==*/
    $check_user=conexion();
    $check_user=$check_user->query("SELECT usuario_id FROM usuario WHERE 
    usuario_id='$user_id_del'");

    $check_admin=conexion();
    $check_admin=$check_admin->query("SELECT usuario_admin,usuario_admin_pass FROM usuario WHERE usuario_admin='' AND usuario_id='".$_SESSION['id']."'");

    if ($check_user->rowCount()==1){

        /*== Verificando productos ==*/
        $check_produc=conexion();
        $check_produc=$check_produc->query("SELECT usuario_id FROM producto WHERE 
        usuario_id='$user_id_del' LIMIT 1");

            /*== Eliminación del Usuario ==*/
            if($check_produc && $check_admin->rowCount()<=0){
                $delete_user=conexion();
                $delete_user=$delete_user->prepare("DELETE FROM usuario WHERE usuario_id=:id");

                $delete_user->execute([":id"=>$user_id_del]);
            
            if($delete_user->rowCount()==1){
                echo '
                <div class="notification is-info is-light">
                    <strong>¡Usuario Eliminado!</strong><br>
                    El usuario y sus datos han sido eliminados sastifactoriamente.
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
                        No podemos eliminar el usuario por dos posibles razones: <br>
                        1) <strong>Usted</strong> no posee privilegios de administrador <br>
                        2) El usuario <strong>tiene</strong> productos registrados.
                    </div>
                    ';
            }
            
        $check_produc=null;

    } else {
        echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            El usuario que intenta eliminar no existe.
        </div>
        ';
    }
    
    $check_user=null;

?>