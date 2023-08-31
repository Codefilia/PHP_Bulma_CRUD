<?php
	/*== Inicializando la vista y el registro ==*/
	$inicio = ($page>0) ? (($page * $registros)-$registros) : 0;
	$table="";

    /*== Condicionales para la busqueda de los terminos ==*/
	if(isset($busqueda) && $busqueda!=""){

		$consulta_datos="SELECT * FROM materia WHERE materia_nombre 
        LIKE '%$busqueda%' OR materia_stock LIKE '%$busqueda%' 
        ORDER BY materia_nombre ASC LIMIT $inicio,$registros";

		$consulta_total="SELECT COUNT(materia_id) FROM materia WHERE materia_nombre 
        LIKE '%$busqueda%' OR materia_stock LIKE '%$busqueda%'";


	}else{

		$consulta_datos="SELECT * FROM materia ORDER BY materia_nombre ASC LIMIT $inicio,$registros";

		$consulta_total="SELECT COUNT(materia_id) FROM materia";
		
	}
	/*== Conexion a DB ==*/
	$conexion=conexion();

  /*== Recorrido a la DATA de la DB ==*/
	$mp_data = $conexion->query($consulta_datos);
	$mp_data = $mp_data->fetchAll();

	$total = $conexion->query($consulta_total);
	$total = (int) $total->fetchColumn();

	$npages =ceil($total/$registros);

	/*== Creacion de FRONTEND de la tabla ==*/
	$table.='
	<div class="table-container">
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
                <tr class="has-text-centered">
                	<th><i class="fa-solid fa-list"></i></th>
                    <th>Nombres</th>
                    <th>Kilogramos o Litros</th>
                    <th colspan="2">
						<span class="icon-text">
						<span class="icon">
						<i class="fa-solid fa-check-to-slot"></i>
						</span>
						<span>Opciones</span>
			  		</th>
                </tr>
            </thead>
            <tbody>
	';

	/*== Insertando los datos ==*/
	if($total>=1 && $page<=$npages){
		$contador=$inicio+1;
		$pag_inicio=$inicio+1;
		foreach($mp_data as $rows){
			$table.='
				<tr class="has-text-centered" >
					<td>'.$contador.'</td>
                    <td>'.$rows['materia_nombre'].'</td>
                    <td>'.$rows['materia_stock'].'</td>
                    <td>
                        <a href="index.php?vista=mp_update&mp_id_up='.$rows['materia_id'].'" class="button is-success is-rounded is-small"><span class="icon-text">
						<span class="icon">
						<i class="fa-solid fa-pen"></i>
						</span>
						<span>Actualizar</span></button></a>
                    </td>
                    <td>
                        <a href="'.$url.$page.'&mp_id_del='.$rows['materia_id'].'" class="button is-danger is-rounded is-small" onclick="return myConfirm();"><span class="icon-text">
						<span class="icon">
						<i class="fa-solid fa-trash-slash"></i>
						</span>
						<span>Eliminar</span></button></a>
                    </td>
                </tr>
            ';
            $contador++;
		}
		$pag_final=$contador-1; # Boton inicial del paginador #
	}else{
		if($total>=1){
			$table.='
				<tr class="has-text-centered" >
					<td colspan="7">
						<a href="'.$url.'1" class="button is-link is-rounded is-small mt-4 mb-4">
							Haga clic acá para recargar el listado
						</a>
					</td>
				</tr>
			';
		}else{
			$table.='
				<tr class="has-text-centered" >
					<td colspan="7">
						No hay registros en el sistema
					</td>
				</tr>
			';
		}
	}


	$table.='</tbody></table></div>';

	if($total>0 && $page<=$npages){
		$table.='<p class="has-text-right">Mostrando usuarios <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';
	}

	/*== Si no hay registros ==*/
	$conexion=null;
	echo $table;

	if($total>=1 && $page<=$npages){
		echo paginador_tablas($page,$npages,$url,7);
	}
?>

<script>
function myConfirm() {
  var result = confirm("¿Desea eliminar esta materia prima?");
  if (result==true) {
   return true;
  } else {
   return false;
  }
}
</script>
