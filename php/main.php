<?php

    /*== Conexion a DB ==*/
    function conexion(){
        $pdo = new PDO('mysql:host=localhost;port=3306;dbname=id20966456_db', 'id20966456_codefilia', 'Afrr.$1996xx');
        return $pdo;    
        }

    /*== Verificacion de la DATA ==*/
    function verificar_datos($filter, $string){
        if(preg_match("/^".$filter."$/",$string)){
            return false;
        }else{ 
            return true;
        }
    }

    /*== Limpieza de STRINGS ==*/
    function limpiar_strings($string){
        $string=trim($string);
        $string=stripslashes($string);
            $string=str_ireplace("<script>", "", $string);
            $string=str_ireplace("</script>", "", $string);
            $string=str_ireplace("<script src", "", $string);
            $string=str_ireplace("<script type=", "", $string);
            $string=str_ireplace("SELECT * FROM", "", $string);
            $string=str_ireplace("DELETE FROM", "", $string);
            $string=str_ireplace("INSERT INTO", "", $string);
            $string=str_ireplace("DROP TABLE", "", $string);
            $string=str_ireplace("DROP DATABASE", "", $string);
            $string=str_ireplace("TRUNCATE TABLE", "", $string);
            $string=str_ireplace("SHOW TABLES;", "", $string);
            $string=str_ireplace("SHOW DATABASES;", "", $string);
            $string=str_ireplace("<?php", "", $string);
            $string=str_ireplace("?>", "", $string);
            $string=str_ireplace("--", "", $string);
            $string=str_ireplace("^", "", $string);
            $string=str_ireplace("<", "", $string);
            $string=str_ireplace("[", "", $string);
            $string=str_ireplace("]", "", $string);
            $string=str_ireplace("==", "", $string);
            $string=str_ireplace(";", "", $string);
            $string=str_ireplace("::", "", $string);
            $string=trim($string);
            $string=stripslashes($string);
        return $string;
    }

    /*== Funcion Renombrar Fotos ==*/
    function renombrar_fotos($rename_photo){
        $rename_photo=str_ireplace(" ", "_", $rename_photo);
        $rename_photo=str_ireplace("/", "_", $rename_photo);
        $rename_photo=str_ireplace("#", "_", $rename_photo);
        $rename_photo=str_ireplace("-", "_", $rename_photo);
        $rename_photo=str_ireplace("$", "_", $rename_photo);
        $rename_photo=str_ireplace(".", "_", $rename_photo);
        $rename_photo=str_ireplace(",", "_", $rename_photo);
        $rename_photo=$rename_photo."_".rand(0,100);
        return $rename_photo;
    }

    /*== Funcion Paginador de Tablas ==*/
    function paginador_tablas($page,$npages,$url,$buttons){
        $table='<nav class="pagination is-centered is-rounded" role="navigation" aria-label="pagination">';

        /*== Navegacion de botones a primera pagina ==*/
        if($page<=1){
            $table.='
            <a class="pagination-previous is-disabled" disabled >Anterior</a>
            <ul class="pagination-list">';
        }else{
            $table.='
            <a class="pagination-previous" href="'.$url.($page-1).'" >Anterior</a>
            <ul class="pagination-list">
                <li><a class="pagination-link" href="'.$url.'1">1</a></li>
                <li><span class="pagination-ellipsis">&hellip;</span></li>
            ';
        }

    /*== Contador para el aumento de botones en pantalla ==*/
        $contador_i=0;
        for($i=$page; $i<=$npages; $i++){
            if($contador_i>=$buttons){
                break;
            }
            if($page==$i){
                $table.='<li><a class="pagination-link is-current" href="'.$url.$i.'">'.$i.'</a></li>';
            }else{
                $table.='<li><a class="pagination-link" href="'.$url.$i.'">'.$i.'</a></li>';
            }
            $contador_i++;
        }

        /*== Navegacion de botones a una segunda pagina ==*/
        if($page==$npages){
            $table.='
            </ul>
            <a class="pagination-next is-disabled" disabled >Siguiente</a>
            ';
        }else{
            $table.='
                <li><span class="pagination-ellipsis">&hellip;</span></li>
                <li><a class="pagination-link" href="'.$url.$npages.'">'.$npages.'</a></li>
            </ul>
            <a class="pagination-next" href="'.$url.($page+1).'" >Siguiente</a>
            ';
        }

        $table.='</nav>';
        return $table;
    }
    
?>