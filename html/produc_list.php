<div class="container is-fluid mb-6">
    <h1 class="title">Productos</h1>
    <h2 class="subtitle">Lista de productos</h2>
</div>

<div class="container pb-6 pt-6">
    
    <?php
        require_once "./php/main.php";

        # Eliminar producto #
        if(isset($_GET['product_id_del'])){
            require_once "./php/produc_delete.php";
        }

        if(!isset($_GET['page'])){
            $page=1;
        }else{
            $page=(int) $_GET['page'];
            if($page<=1){
                $page=1;
            }
        }

        $categoria_id = (isset($_GET['categoria_id'])) ? $_GET['categoria_id'] : 0;

        $page=limpiar_strings($page);
        $url="index.php?vista=produc_list&page="; /* <== */
        $registros=3;
        $busqueda="";

        # Paginador producto #
        require_once "./php/produc_lists.php";
    ?>
</div>