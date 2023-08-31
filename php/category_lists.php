<?php
    /*== Inicializando la vista y el registro ==*/
    $inicio = ($page>0) ? (($page * $registros)-$registros) : 0;
	$table="";

    /*== Condicionales para la busqueda de los terminos ==*/
	if(isset($busqueda) && $busqueda!=""){

		$consulta_datos="SELECT * FROM categoria WHERE cat_nombre 
        LIKE '%$busqueda%' OR cat_ubicacion LIKE '%$busqueda%' 
        ORDER BY cat_nombre ASC LIMIT $inicio,$registros";

		$consulta_total="SELECT COUNT(categoria_id) FROM categoria WHERE cat_nombre 
        LIKE '%$busqueda%' OR cat_ubicacion LIKE '%$busqueda%'";

	}else{

		$consulta_datos="SELECT * FROM categoria ORDER BY cat_nombre ASC LIMIT $inicio,$registros";

		$consulta_total="SELECT COUNT(categoria_id) FROM categoria";
		
	}

    /*== Conexion a DB ==*/
	$conexion=conexion();

    /*== Recorrido a la DATA de la DB ==*/
	$category_data = $conexion->query($consulta_datos);
	$category_data = $category_data->fetchAll();

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
                    <th>Nombre</th>
                    <th>Ubicación</th>
                    <th>Productos</th>
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
		foreach($category_data as $rows){
			$table.='
				<tr class="has-text-centered" >
					<td>'.$contador.'</td>
                    <td>'.$rows['cat_nombre'].'</td>
                    <td>'.substr($rows['cat_ubicacion'],0,25).'</td>
                    <td>
                        <a href="index.php?vista=produc_category&category_id='.$rows['categoria_id'].'" class="button is-link is-rounded is-small">Ver productos</a>
                    </td>
                    <td>
                        <a href="index.php?vista=category_update&category_id_up='.$rows['categoria_id'].'" class="button is-success is-rounded is-small"><span class="icon">
						<i class="fa-solid fa-pen"></i>
						</span>
						<span>Actualizar</span></button></a>
                    </td>
                    <td>
                        <a href="'.$url.$page.'&category_id_del='.$rows['categoria_id'].'" class="button is-danger is-rounded is-small" onclick="return myConfirm();"><span class="icon">
						<i class="fa-solid fa-trash-slash"></i>
						</span>
						<span>Eliminar</span></button></a>
                    </td>
                </tr>
            ';
            $contador++;
		}
		$pag_final=$contador-1; # Boton inicial del paginador 
	}else{
		if($total>=1){
			$table.='
				<tr class="has-text-centered" >
					<td colspan="5">
						<a href="'.$url.'1" class="button is-link is-rounded is-small mt-4 mb-4">
							Haga clic acá para recargar el listado
						</a>
					</td>
				</tr>
			';
		}else{
			$table.='
				<tr class="has-text-centered" >
					<td colspan="5">
						No hay registros en el sistema
					</td>
				</tr>
			';
		}
	}


	$table.='</tbody></table></div>';

	if($total>0 && $page<=$npages){
		$table.='<p class="has-text-right">Mostrando categorías <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';
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
  var result = confirm("¿Desea eliminar esta categoria?");
  if (result==true) {
   return true;
  } else {
   return false;
  }
}
</script>
