<?php
    require_once "./php/main.php";

    $id=(isset($_GET['user_id_up'])) ?  $_GET['user_id_up'] : 0;
    $id=limpiar_strings($id);

    $check_user=conexion();
    $check_user=$check_user->query("SELECT * FROM usuario WHERE usuario_id='$id'");
    
    if ($check_user->rowCount()>0){
        $user_data=$check_user->fetch();
    }
?>

<!-- Vista Principal-->
<div class="container">
    <div class="main-body">
          <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
                <br><br>
              <li class="breadcrumb-item active" aria-current="page"><strong>Perfil de <?php echo $_SESSION['usuario']?></strong></li>
            </ol>
          </nav>

<!-- Caja de Usuario-->
<div class="row gutters-sm">
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-column align-items-center text-center">
                    <p class="has-text-centered">
                    <img src="https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_960_720.png" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                    <h4><?php echo $_SESSION['nombre']?> <?php echo $_SESSION['apellido']?></h4>
                    <p class="has-text-centered"><?php echo $user_data['usuario_email'];?></p>
                        <p class="has-text-centered">
                            <a href="index.php?vista=user_update&user_id_up=<?php echo $_SESSION['id']; ?>" class="button is-primary is-rounded is-info">
                            <span class="icon-text">
                            <span class="icon">
                            <i class="fa-solid fa-wrench"></i>
                            </span>
                            <span>Editar Perfil</span></button>
                            </a>
                        </p>
                    </p>
                </div>
            </div>
        </div>
 </div>