<!-- Buscador de Usuarios -->
<div class="container is-fluid mb-6">
    <h1 class="title">Materia Prima</h1>
    <h2 class="subtitle">Busqueda de Materia Prima</h2>
</div>

<div class="container pb-6 pt-6">

    <?php
        require_once "./php/main.php";

        if (isset($_POST['modulo_buscador'])){
            require_once "./php/search.php";
        }

        if (!isset($_SESSION['busqueda_materia']) && empty($_SESSION['busqueda_materia'])) {
    ?>

<!-- Barra de busqueda y botón "BUSCAR" -->
<div class="container pb-6 pt-6">

    <div class="columns">
        <div class="column">
            <form action="" method="POST" autocomplete="off">
                <input type="hidden" name="modulo_buscador" value="materia">
                    <div class="field is-grouped">
                        <p class= "control is-expanded">
                            <input class="input is-rounded" type="text" name="txt_buscador" placeholder="¿Que estás buscando?" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" maxlength="30">
                        </p>
                        <p class="control">
                            <button class="button is-info is-rounded" type="submit"><span class="icon-text">
                            <span class="icon">
		                    <i class="fa-solid fa-magnifying-glass"></i>
                            </span>
                            <span>Buscar</span></button>
                        </p>
                    </div>
            </div>
        </form>
    </div>
</div>

    <?php } else 

    { ?>

<!-- Resultado de la busqueda -->
<div class="columns">
    <div class="column">
        <form class="has-text-centered mt-6 mb-6" action="" method="POST" autocomplete="off">
            <input type="hidden" name="modulo_buscador" value="materia">
            <input type="hidden" name="eliminar_buscador" value="materia">
            <p>Estás buscando el siguiente término: <strong> <?php echo $_SESSION['busqueda_materia']; ?> </strong></p>
            <br>
            <button type="submit" class="button is-danger is-rounded">
                <span class="icon-text">
				<span class="icon">
				<i class="fa-solid fa-arrow-rotate-left"></i>
				</span>
				<span>Eliminar busqueda</span>
            </button>
        </form>
    </div>
</div>

    <?php 
        require_once "./php/main.php";

            /*== Eliminar Materia Prima ==*/
            if(isset($_GET['mp_id_del'])){
                require_once "./php/mp_delete.php";
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
            $url="index.php?vista=mp_search&page=";
            $registros=10;
            $busqueda=$_SESSION['busqueda_materia'];

        /*== Paginador de materia prima ==*/
        require_once "./php/mp_lists.php";
    }
    ?>