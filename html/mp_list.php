<!-- Listas de Materia Prima -->
<div class="container is-fluid mb-6">
    <h1 class="title">Materia Prima</h1>
    <h2 class="subtitle">Lista de Materia Prima</h2>
</div>

<!-- Creacion de Tabla -->
<div class="container pb-6 pt-6">  
    <?php
        # Agarrar desde main la pagina #
        require_once "./php/main.php";

        if(!isset($_GET['page'])){
            $page=1;
        }else{
            $page=(int) $_GET['page'];
            if($page<=1){
                $page=1;
            }
        }

        /*== Eliminar Materia Prima ==*/
        if(isset($_GET['mp_id_del'])){
            require_once "./php/mp_delete.php";
        }
    

        $page=limpiar_strings($page);
        $url="index.php?vista=mp_list&page=";
        $registros=5;
        $busqueda="";

        /*== Paginador Mateia Prima ==*/
        require_once "./php/mp_lists.php";
        
    ?>
</div>

