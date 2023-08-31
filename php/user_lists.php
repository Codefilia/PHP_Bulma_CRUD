<?php
	/*== Inicializando la vista y el registro ==*/
	$inicio = ($page>0) ? (($page * $registros)-$registros) : 0;
	$table="";

	/*== Condicionales para la busqueda de los terminos ==*/
	if(isset($busqueda) && $busqueda!=""){

		$consulta_datos="SELECT * FROM usuario WHERE ((usuario_id!='".$_SESSION['id']."') 
        AND (usuario_nombre LIKE '%$busqueda%' OR usuario_apellido LIKE '%$busqueda%' 
        OR usuario_usuario LIKE '%$busqueda%' OR usuario_email LIKE '%$busqueda%')) 
        ORDER BY usuario_nombre ASC LIMIT $inicio,$registros";

		$consulta_total="SELECT COUNT(usuario_id) FROM usuario WHERE ((usuario_id!='".$_SESSION['id']."') 
        AND (usuario_nombre LIKE '%$busqueda%' OR usuario_apellido LIKE '%$busqueda%' 
        OR usuario_usuario LIKE '%$busqueda%' OR usuario_email LIKE '%$busqueda%'))";

	}else{

		$consulta_datos="SELECT * FROM usuario WHERE usuario_id!='".$_SESSION['id']."' 
        ORDER BY usuario_nombre ASC LIMIT $inicio,$registros";

		$consulta_total="SELECT COUNT(usuario_id) FROM usuario WHERE usuario_id!='".$_SESSION['id']."'";
		
	}
	/*== Conexion a DB ==*/
	$conexion=conexion();

	/*== Recorrido a la DATA de la DB ==*/
	$data = $conexion->query($consulta_datos);
	$data = $data->fetchAll();

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
                    <th>Apellidos</th>
                    <th>Usuario</th>
                    <th>Correo Electronico</th>
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
		foreach($data as $rows){
			$table.='
				<tr class="has-text-centered" >
					<td>'.$contador.'</td>
                    <td>'.$rows['usuario_nombre'].'</td>
                    <td>'.$rows['usuario_apellido'].'</td>
                    <td>'.$rows['usuario_usuario'].'</td>
                    <td>'.$rows['usuario_email'].'</td>
                    <td>
                        <a href="index.php?vista=user_update&user_id_up='.$rows['usuario_id'].'" class="button is-success is-rounded is-small"><span class="icon-text">
						<span class="icon">
						<i class="fa-solid fa-pen"></i>
						</span>
						<span>Actualizar</span></button></a>
                    </td>
                    <td>
                        <a href="'.$url.$page.'&user_id_del='.$rows['usuario_id'].'" class="button is-danger is-rounded is-small" onclick="return myConfirm();"><span class="icon-text">
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
  var result = confirm("¿Desea eliminar este usuario?");
  if (result==true) {
   return true;
  } else {
   return false;
  }
}
</script>
