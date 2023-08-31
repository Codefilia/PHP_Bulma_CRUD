<!-- Registro para un Nuevo Usuario -->
<div class="container is-fluid mb-6">
	<h1 class="title">Usuarios</h1>
	<h2 class="subtitle">Nuevo usuario</h2>
</div>
<div class="container pb-6 pt-6">

	<div class="form-rest mb-6 mt-6"></div>

	<!-- Formulario de JS -->
	<form action="./php/user_save.php" method="POST" class="FormularioAjax" autocomplete="off" >
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<!-- Caja de Nombres -->
					<label>Nombres</label>
					<p class="control has-icons-left has-icons-right">
				  	<input class="input" type="text" name="usuario_nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required 
					  placeholder="Ej: Juan">
					  <span class="icon is-small is-left">
					  <i class="fa-regular fa-signature"></i>
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<!-- Caja de Apellidos -->
					<label>Apellidos</label>
					<p class="control has-icons-left has-icons-right">
				  	<input class="input" type="text" name="usuario_apellido" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required 
					  placeholder="Ej: Martinez">
					  <span class="icon is-small is-left">
					  <i class="fa-regular fa-signature"></i>
				</div>
		  	</div>
		</div>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<!-- Caja de Nombre de Usuario -->
					<label>Usuario</label>
					<p class="control has-icons-left has-icons-right">
				  	<input class="input" type="text" name="usuario_usuario" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" required 
					  placeholder="Ej: JuanMartinez">
					<span class="icon is-small is-left">
					<i class="fa-solid fa-users-medical"></i>
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Correo Electronico</label>
					<!-- Caja de Correo Electronico -->
					<p class="control has-icons-left has-icons-right">
					<input class="input" type="email" name="usuario_email" maxlength="70" 
					  placeholder="Ej: juanmartinez@gmail.com">
					  <span class="icon is-small is-left">
      				  <i class="fas fa-envelope"></i>
				</div>
		  	</div>
		</div>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Clave</label>
					<p class="control has-icons-left">
				  	<input class="input" type="password" name="usuario_clave_1" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required >
					  <span class="icon is-small is-left">
					  <i class="fas fa-lock"></i>
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Repetir Clave</label>
					<p class="control has-icons-left">
				  	<input class="input" type="password" name="usuario_clave_2" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required >
					  <span class="icon is-small is-left">
					  <i class="fas fa-lock"></i>
				</div>
		  	</div>
		</div>
		<p class="has-text-centered">
			<button type="submit" class="button is-info is-rounded">
				<span class="icon-text">
				<span class="icon">
				<i class="fa-solid fa-cloud-arrow-up"></i>
				</span>
				<span>Guardar</span></button>
		</p>
	</form>
</div>

<?php
	include "./inc/preloader.php"; 
?>