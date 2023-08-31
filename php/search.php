<?php
    /*== Inicio del modulo buscador ==*/
    $modulo_buscador=limpiar_strings($_POST['modulo_buscador']);
    
    $modulos=["usuario","categoria","producto", "materia"];

    if (in_array($modulo_buscador,$modulos)) {

        $modulos_url=[
            "usuario"=>"user_search",
            "categoria"=>"category_search",
            "producto"=>"produc_search",
            "materia"=>"mp_search",
        ];

        $modulos_url=$modulos_url[$modulo_buscador];

        $modulo_buscador="busqueda_".$modulo_buscador;
        
        /*== Iniciar Busqueda ==*/
        if(isset($_POST['txt_buscador'])){
            $txt=limpiar_strings($_POST['txt_buscador']);
                if ($txt==""){
                    echo '
                        <div class="notification is-danger is-light">
                            <strong>¡Ocurrio un error inesperado!</strong><br>
                            No ha introducido texto en el cuadro de busqueda, por favor, introduzca un terminal de busqueda
                        </div>
                        ';
                }else{
                        if (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}", $txt)){
                        echo '
                        <div class="notification is-danger is-light">
                            <strong>¡Ocurrio un error inesperado!</strong><br>
                            La BUSQUEDA no coincide con el formato solicitado
                        </div>
                        '; 
                        } else {
                            $_SESSION[$modulo_buscador]=$txt;
                            header("Location: index.php?vista=$modulos_url",true,303);
                            ob_end_flush();
                            exit();
                        }

                }
        }
        
        /*== Eliminar busqueda ==*/
        if(isset($_POST['eliminar_buscador'])){
            unset($_SESSION[$modulo_buscador]);
            header("Location: index.php?vista=$modulos_url",true,303);
            exit();
        }

    }else{
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            No podemos procesar la busqueda solicitada.
        </div>
        ';
    }
?>

