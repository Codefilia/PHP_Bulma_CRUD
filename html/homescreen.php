<!-- Pagina Principal -->
<div class="container is-fluid">
	<h1 class="title">Página Principal</h1>
	<h2 class="subtitle">¡Bienvenido a la página, usuario <strong><?php echo $_SESSION['usuario']?></strong>!</h2>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	
	<div class="display-date"><h1 class="title"><span id="day">Dia</span>,
		<span id="daynum">00</span>
		<span id="month">Mes</span>
		<span id="year">0000</span>
		</h1>
	</div>
	<div class="display-time"></div>
</div>

<script src="./js/date.js"></script>