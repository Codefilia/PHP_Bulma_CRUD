<!-- Listas de Usuarios Registrados -->
<div class="container is-fluid mb-6">
    <h1 class="title">Usuarios</h1>
    <h2 class="subtitle">Lista de usuarios</h2>
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

        /*== Eliminar Usuario ==*/
        if(isset($_GET['user_id_del'])){
            require_once "./php/user_delete.php";
        }
    

        $page=limpiar_strings($page);
        $url="index.php?vista=user_list&page=";
        $registros=5;
        $busqueda="";

        /*== Paginador Usuario ==*/
        require_once "./php/user_lists.php";
        
    ?>
</div>

