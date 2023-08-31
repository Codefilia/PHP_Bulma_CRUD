<?php
	$inicio = ($page>0) ? (($page * $registros)-$registros) : 0;
	$table="";

	$inputs="producto.producto_id,producto.produc_codigo,
    producto.produc_nombre,producto.produc_precio,producto.produc_stock,
    producto.produc_images,producto.categoria_id,producto.usuario_id,categoria.categoria_id,
    categoria.cat_nombre,usuario.usuario_id,usuario.usuario_usuario";

	if(isset($busqueda) && $busqueda!=""){

		$consulta_datos="SELECT $inputs FROM producto INNER JOIN categoria ON producto.categoria_id=categoria.categoria_id 
        INNER JOIN usuario ON producto.usuario_id=usuario.usuario_id WHERE producto.produc_codigo 
        LIKE '%$busqueda%' OR producto.produc_nombre LIKE '%$busqueda%' ORDER BY producto.produc_nombre 
        ASC LIMIT $inicio,$registros";

		$consulta_total="SELECT COUNT(producto_id) FROM producto WHERE produc_codigo LIKE '%$busqueda%' 
        OR produc_nombre LIKE '%$busqueda%'";

	}elseif($categoria_id>0){

		$consulta_datos="SELECT $inputs FROM producto INNER JOIN categoria 
        ON producto.categoria_id=categoria.categoria_id INNER JOIN usuario 
        ON producto.usuario_id=usuario.usuario_id WHERE producto.categoria_id='$categoria_id' 
        ORDER BY producto.produc_nombre ASC LIMIT $inicio,$registros";

		$consulta_total="SELECT COUNT(producto_id) FROM producto WHERE categoria_id='$categoria_id'";

	}else{

		$consulta_datos="SELECT $inputs FROM producto INNER JOIN categoria 
        ON producto.categoria_id=categoria.categoria_id INNER JOIN usuario 
        ON producto.usuario_id=usuario.usuario_id ORDER BY producto.produc_nombre 
        ASC LIMIT $inicio,$registros";

		$consulta_total="SELECT COUNT(producto_id) FROM producto";

	}

	$conexion=conexion();

	$data = $conexion->query($consulta_datos);
	$data = $data->fetchAll();

	$total = $conexion->query($consulta_total);
	$total = (int) $total->fetchColumn();

	$npages =ceil($total/$registros);

	if($total>=1 && $page<=$npages){
		$contador=$inicio+1;
		$pag_inicio=$inicio+1;
		foreach($data as $rows){
			$table.='
				<article class="media">
			        <figure class="media-left">
			            <p class="image is-64x64">';
			            if(is_file("./img/producto/".$rows['produc_images'])){
			            	$table.='<img src="./img/producto/'.$rows['produc_images'].'">';
			            }else{
			            	$table.='<img src="./img/producto.png">';
			            }
			   $table.='</p>
			        </figure>
			        <div class="media-content">
			            <div class="content">
			              <p>
			                <strong>#'.$contador.' - '.$rows['produc_nombre'].'</strong><br>
			                <strong>| CODIGO:</strong> '.$rows['produc_codigo'].' <strong>| PRECIO:</strong> $'.$rows['produc_precio'].' <strong>| STOCK:</strong> '.$rows['produc_stock'].' <strong>| CATEGORIA:</strong> '.$rows['cat_nombre'].' <strong>| REGISTRADO POR:</strong> '.$rows['usuario_usuario'].'<strong> |</strong>
			              </p>
			            </div>
			            <div class="has-text-right">
			                <a href="index.php?vista=produc_img&product_id_up='.$rows['producto_id'].'" class="button is-link is-rounded is-small">
							<span class="icon">
							<i class="fa-solid fa-image"></i>
							</span>
							<span>Imagen</span></button></a>
			                
							<a href="index.php?vista=produc_update&product_id_up='.$rows['producto_id'].'" class="button is-success is-rounded is-small">
							<span class="icon">
							<i class="fa-solid fa-pen"></i>
							</span>
							<span>Actualizar</span></button></a>

			                <a href="'.$url.$page.'&product_id_del='.$rows['producto_id'].'" class="button is-danger is-rounded is-small" onclick="return myConfirm();">
							<span class="icon">
							<i class="fa-solid fa-trash-slash"></i>
							</span>
							<span>Eliminar</span></button></a>
			            </div>
			        </div>
			    </article>
			    <hr>
            ';
            $contador++;
		}
		$pag_final=$contador-1;
	}else{
		if($total>=1){
			$table.='
				<p class="has-text-centered" >
					<a href="'.$url.'1" class="button is-link is-rounded is-small mt-4 mb-4">
						Haga clic acá para recargar el listado
					</a>
				</p>
			';
		}else{
			$table.='
				<p class="has-text-centered" >No hay registros en el sistema</p>
			';
		}
	}

	if($total>0 && $page<=$npages){
		$table.='<p class="has-text-right">Mostrando productos <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';
	}

	$conexion=null;
	echo $table;

	if($total>=1 && $page<=$npages){
		echo paginador_tablas($page,$npages,$url,7);
	}

?>

<script>
function myConfirm() {
var result = confirm("¿Desea eliminar este producto?");
  if (result==true) {
   	return true;
  	} 
	else {
   	return false;
  }
}
</script>