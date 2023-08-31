<div class="container is-fluid mb-6">
    <h1 class="title">Categorías</h1>
    <h2 class="subtitle">Lista de categoría</h2>
</div>

<div class="container pb-6 pt-6">
    <?php
        require_once "./php/main.php";

        # Eliminar categoria #
        if(isset($_GET['category_id_del'])){
            require_once "./php/category_delete.php";
        }

        if(!isset($_GET['page'])){
            $page=1;
        }else{
            $page=(int) $_GET['page'];
            if($page<=1){
                $page=1;
            }
        }

        $page=limpiar_strings($page);
        $url="index.php?vista=category_list&page="; /* <== */
        $registros=5;
        $busqueda="";

        # Paginador categoria #
        require_once "./php/category_lists.php";

        
    ?>
</div>