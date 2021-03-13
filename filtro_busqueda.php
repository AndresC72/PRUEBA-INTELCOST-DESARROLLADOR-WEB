<?php

////////////////// CONEXION A LA BASE DE DATOS ////////////////////////////////////

require 'conexion.php';

////////////////// VARIABLES DE CONSULTA////////////////////////////////////

$where="";
$ciudad=$_POST['xciudad'];
$tipo=$_POST['xtipo'];
$limit=$_POST['xregistros'];

////////////////////// BOTON BUSCAR //////////////////////////////////////

if (isset($_POST['buscar']))
{

	

	if (empty($_POST['xtipo']))
	{
		$where="where ciudad like '".$ciudad."%'";
	}

	else if (empty($_POST['xnombre']))
	{
		$where="where tipo ='".$tipo."'";
	}

	else
	{
		$where="where ciudad like '".$ciudad."%' and tipo='".$tipo."'";
	}
}
/////////////////////// CONSULTA A LA BASE DE DATOS ////////////////////////

$ciudades="SELECT * FROM ciudad $where $limit";
$resCiudades=$conexion->query($ciudades);
$resTipos=$conexion->query($ciudades);

if(mysqli_num_rows($resCiudades)==0)
{
	$mensaje="<h1>No hay registros que coincidan con su criterio de búsqueda.</h1>";
}
?>
<html lang="es">

	<head>
		<title>Filtro de Búsqueda PHP</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

		<link href="css/estilos.css" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

	</head>
	<body>
		<header>
			<div class="alert alert-info">
			<h2>Filtro de Búsqueda PHP</h2>
			</div>
		</header>
		<section>
			<form method="post">
				<input type="text" placeholder="Ciudad..." name="xciudad"/>
				<select name="xtipo">
					<option value="">Carrera </option>
					<?
						while ($registroTipos = $resTipos->fetch_array(MYSQLI_BOTH))
						{
							echo '<option value="'.$registroTipos['tipo'].'">'.$registroTipos['tipo'].'</option>';
						}
					?>
				</select>

				<select name="xregistros">
					<option value="">No. de Registros</option>
					<option value="limit 3">3</option>
					<option value="limit 6">6</option>
					<option value="limit 9">9</option>
				</select>
				<button name="buscar" type="submit">Buscar</button>
			</form>
			<table class="table">
				<tr>
					<th>Id</th>
					<th>Direccion</th>
					<th>Ciudad</th>
					<th>Telefono</th>
					<th>Codigo Postal</th>
					<th>Tipo</th>
					<th>Precio</th>
				</tr>

				<?php

				while ($registroCiudades = $resCiudades->fetch_array(MYSQLI_BOTH))
				{

					echo'<tr>
						 <td>'.$registroCiudades['id'].'</td>
						 <td>'.$registroCiudades['direccion'].'</td>
						 <td>'.$registroCiudades['ciudad'].'</td>
						 <td>'.$registroCiudades['telefono'].'</td>
						 <td>'.$registroCiudades['codigo_postal'].'</td>
						 <td>'.$registroCiudades['tipo'].'</td>
						 <td>'.$registroCiudades['precio'].'</td>
						 </tr>';
				}
				?>
			</table>

			<?
				echo $mensaje;
			?>
		</section>
	</body>
</html>


