<!-- Pagina Inicio de Sesion -->
<div class="main-container">

    <form class="box login" action="" method="POST" autocomplete="off">
		<h5 class="title is-5 has-text-centered is-uppercase">Sistema de inventario</h5>
		<!-- Caja de Usuario -->
		<div class="field">
			<label class="label"><i class="fa-solid fa-user-group"></i>Usuario</label>
			<div class="control">
			    <input class="input" type="text" name="login_usuario" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" required >
			</div>
		</div>
		<!-- Caja de Clave -->
		<div class="field">
		  	<label class="label"><i class="fa-solid fa-lock"></i> Clave</label>
		  	<div class="control">
		    	<input class="input" type="password" name="login_clave" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required >
		  	</div>
		</div>
			<!-- Boton "Inicio de Sesion" -->
		<p class="has-text-centered mb-4 mt-3">
			<button type="submit" class="button is-info is-rounded">Iniciar sesion</button>
		</p>
		<?php 
			include "./inc/preloader.php";
		?>
	</form>
	
	<?php
			#Proceso para Iniciar Sesion#
		if(isset($_POST['login_usuario']) && isset($_POST['login_clave'])
		){
			require_once "./php/main.php";
			require_once "./php/session_started.php";
		}
	?>
</div>
