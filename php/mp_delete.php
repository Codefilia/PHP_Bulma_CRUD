<?php
	/*== Almacenando datos ==*/
    $mp_id_del=limpiar_strings($_GET['mp_id_del']);

    /*== Verificando producto ==*/
    $mp_check=conexion();
    $mp_check=$mp_check->query("SELECT * FROM materia WHERE materia_id='$mp_id_del'");

     if ($mp_check->rowCount()==1){

        $mp_check=conexion();
        $mp_check=$mp_check->query("SELECT materia_id FROM materia WHERE
        materia_id='$mp_id_del'");

        if($mp_check->rowCount()>=0) {
            $delete_mp=conexion();
            $delete_mp=$delete_mp->prepare("DELETE FROM materia WHERE materia_id=:id");
        
            $delete_mp->execute([":id"=>$mp_id_del]);
            
        if($delete_mp->rowCount()==1){
        
            echo '
            <div class="notification is-info is-light">
                <strong>¡Materia Prima Eliminada!</strong><br>
                La materia prima y sus datos han sido eliminados sastifactoriamente.
            </div>
                ';

            } else {
                    echo '
                        <div class="notification is-danger is-light">
                            <strong>¡Ocurrio un error inesperado!</strong><br>
                            No se pudo eliminar la materia, por favor, intente nuevamente.
                        </div>
                        ';  
                        }
        
        } else {
               echo '
                    <div class="notification is-danger is-light">
                        <strong>¡Ocurrio un error inesperado!</strong><br>
                        No podemos eliminar la materia prima por dos posibles razones: <br>
                        1) <strong>Usted</strong> no posee privilegios de administrador <br>
                        2) Hubo un <strong>error</strong> inesperado
                    </div>
                    ';
        }

    $mp_check=null;

    } else {
            echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La materia prima que intenta eliminar no existe.
            </div>
                ';
            }

    $mp_check=null;

?>