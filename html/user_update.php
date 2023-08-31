<?php
    require_once "./php/main.php";

    $id=(isset($_GET['user_id_up'])) ?  $_GET['user_id_up'] : 0;
    $id=limpiar_strings($id);

	include "./inc/preloader.php"; 
?>

<div class="container is-fluid mb-6">
    <?php  if($id==$_SESSION['id']){  ?>


    <h1 class="title">Mi cuenta</h1>
    <h2 class="subtitle">Actualizar datos de cuenta</h2>


    <?php  } else {  ?>

    <h1 class="title">Usuarios</h1>
    <h2 class="subtitle">Actualizar Usuarios</h2>

    <?php }?>
</div>

<div class="container pb-6 pt-6">

    <?php 
     
     include "./inc/btn_back.php"; 

    $check_user=conexion();
    $check_user=$check_user->query("SELECT * FROM usuario WHERE usuario_id='$id'");
    
    if ($check_user->rowCount()>0){
        $user_data=$check_user->fetch();
    ?>

    <div class="form-rest pb-6 pt-6"></div>
    <form action="./php/user_data_updated.php" method="POST" class="FormularioAjax" autocomplete="off">

        <input type="hidden" value="<?php echo $user_data['usuario_id'];?>" name="usuario_id" required >

        <input type="hidden" name="usuario_id" value="<?php echo $user_data['usuario_id']; ?>" required >
		
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label><strong>Nombres</strong></label>
				  	<input class="input" type="text" name="usuario_nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required value="<?php echo $user_data['usuario_nombre']; ?>" >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label><strong>Apellidos</strong></label>
				  	<input class="input" type="text" name="usuario_apellido" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required value="<?php echo $user_data['usuario_apellido']; ?>" >
				</div>
		  	</div>
		</div>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label><strong>Usuario</strong></label>
				  	<input class="input" type="text" name="usuario_usuario" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" required value="<?php echo $user_data['usuario_usuario']; ?>" >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label><strong>Email</strong></label>
				  	<input class="input" type="email" name="usuario_email" maxlength="70" value="<?php echo $user_data['usuario_email']; ?>" >
				</div>
		  	</div>
		</div>
		<br><br>
		<p class="has-text-centered">
			SI desea actualizar la clave de este usuario por favor llene los 2 campos. Si <strong>NO</strong> desea actualizar la clave deje los campos vacíos.
		</p>
		<br>
		<div class="columns">
			<div class="column">
		    	<div class="control">
					<label><strong>Clave</strong></label>
				  	<input class="input" type="password" name="usuario_clave_1" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label><strong>Repetir Clave</strong></label>
				  	<input class="input" type="password" name="usuario_clave_2" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" >
				</div>
		  	</div>
		</div>
		<br><br><br>
		<p class="has-text-centered">
			Para poder actualizar los datos de este usuario por favor ingrese su <strong>USUARIO</strong> y <strong>CLAVE</strong> con la que ha iniciado sesión
		</p>
		<br>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label><strong>Usuario</strong></label>
				  	<input class="input" type="text" name="administrador_usuario" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label><strong>Clave</strong></label>
				  	<input class="input" type="password" name="administrador_clave" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required >
				</div>
		  	</div>
		</div>
		<p class="has-text-centered">
			<button type="submit" class="button is-success is-rounded"><span class="icon-text">
				<span class="icon">
				<i class="fa-solid fa-turn-up"></i>
				</span>
				<span>Actualizar</span></button>
		</p>
	</form>
    
    <?php } else { 
        include "./inc/error_alert.php";
    }
    $check_user=null;
        ?>
</div>