const displayTime = document.querySelector(".display-time");

		// Hora
		function showTime() {
		let time = new Date();
		displayTime.innerText = time.toLocaleTimeString("en-US", { hour12: true });
		setTimeout(showTime, 1000);
		}

		showTime();

		// Fecha
		function updateDate() {
		let today = new Date();

		// Regresar fecha
		let dayName = today.getDay(),
			dayNum = today.getDate(),
			month = today.getMonth(),
			year = today.getFullYear();

		const months = [
			"Enero",
			"Febrero",
			"Marzo",
			"Abril",
			"Mayo",
			"Junio",
			"Julio",
			"Agosto",
			"Septiembre",
			"Octubre",
			"Noviembre",
			"Diciembre",
		];
		const dayWeek = [
			"Domingo",
			"Lunes",
			"Martes",
			"Miercoles",
			"Jueves",
			"Viernes",
			"Sabado",
		];
		
		const IDCollection = ["day", "daynum", "month", "year"];
	
		const val = [dayWeek[dayName], dayNum, months[month], year];
			for (let i = 0; i < IDCollection.length; i++) {
				document.getElementById(IDCollection[i]).firstChild.nodeValue = val[i];
		}
		}

		updateDate();