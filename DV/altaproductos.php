<?php
	
	session_start();
	require 'conexion.php';
	
	if(!isset($_SESSION["id_usuario"])){
		header("Location: index.php");
	}
	
	$sql = "SELECT id, tipo FROM tipo_usuario";
	$result=$mysqli->query($sql);
	
	$bandera = false;
	
	if(!empty($_POST))
	{
		$tipo_producto = $_POST['tipo_producto'];
		$nombre = mysqli_real_escape_string($mysqli,$_POST['nombre']);
		$costo = mysqli_real_escape_string($mysqli,$_POST['costo']);
		$piezas = mysqli_real_escape_string($mysqli,$_POST['piezas']);
		$descrip = mysqli_real_escape_string($mysqli,$_POST['descrip']);
		$error = '';
		
		$sqlPostre = "SELECT SKU FROM postres WHERE Nombre = '$nombre'";
		
		$resultPostre=$mysqli->query($sqlPostre);
		$rows = $resultPostre->num_rows;
		
		if($rows > 0) {
			$error = "El Producto ya existe";
			} else {
			
			$sqlProducto = "INSERT INTO postres (Tipo, Nombre, Costo, Piezas, Descripcion) VALUES('$tipo_producto','$nombre','$costo','$piezas','$descrip')";
			$resultProducto=$mysqli->query($sqlProducto);
			
			if($resultProducto>0)
			$bandera = true;
			else
			$error = "Error al Registrar";
			
		}
	}
	
?>

<html>
	<head>
		<title>Alta Productos</title>
		<link href = "css/login.css" rel = "stylesheet" type = "text/css">
		<script>
			function validarNombre()
			{
				valor = document.getElementById("nombre").value;
				if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
					alert('Falta Llenar Nombre');
					return false;
				} else { return true;}
			}
			
			function validarCosto()
			{
				valor = document.getElementById("costo").value;
				if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
					alert('Falta Llenar Costo');
					return false;
				} else { return true;}
			}

			function validarPiezas()
			{
				valor = document.getElementById("piezas").value;
				if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
					alert('Falta Llenar piezas');
					return false;
				} else { return true;}
			}
			
			function validarDescripcion()
			{
				valor = document.getElementById("descrip").value;
				if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
					alert('Falta Llenar Descripcion');
					return false;
					} else  { return true; }
					
			}
			
			function validarTipoProducto()
			{
				indice = document.getElementById("tipo_producto").selectedIndex;
				if( indice == null || indice==0 ) {
					alert('Seleccione tipo de Producto');
					return false;
				} else { return true;}
			}
			
			function validar()
			{
				if(validarNombre() && validarCosto() && validarPiezas() && validarDescripcion() && validarTipoProducto() )
				{
					document.registro.submit();
				}
			}
			
		</script>
		
	</head>
	
	<body background="fondo.jpg " >
		
		
		<center>
		<div class="menuadmin" ><img src="imges_DV/NewLogo.png" width="200px" height="200px" />
		<form class="registro" id="registro" name="registro" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" > 
			<fieldset > <legend>Nuevo Producto</legend>
					<br>
					<div><label>Tipo de Producto:</label>
						<select id="tipo_producto" name="tipo_producto">
							<option value="0">Seleccione</option>
							<option value="Cupcake" required>Cupcake</option>
							<option value="Pastel" required>Pastel</option>
							<option value="Flan" required>Flan</option>
							<option value="Chessecake" required>Chessecake</option>
							<option value="Otro" required>Otro</option>
						</select>
					</div>
					<br/>
			
				
				<div><label>Nombre:</label><input id="nombre" name="nombre" type="text"></div>
				<br />
				<div><label>Costo:</label><input id="costo" name="costo" type="text"></div>
				<br />
				<div><label>Piezas:</label><input id="piezas" name="piezas" type="text"></div>
				<br />
				<div><label>Descripcion:</label><input  id="descrip" name="descrip" type="text"></div>
				<br />
				<br />
				
				<div><input id="registrop" name="registrarp" type="button" value="Registrar" onClick="validar();">

				<a href="admin.php" target="_self"> <input type = "button" id="invited" name = "invited" value="Regresar"></div> 



			</fieldset>
			<div class="subindice">Nomenclatura:<br>CK_: Cupcake|  Chk_: Chessecake|  Pst_: Pastel|  Fn_: Flan|  Cn_: Conos|  Mz_: Manzanas</div>
		</form>


		
		</div>
		

		
		<?php if($bandera) { ?>
			<h1>Registro exitoso</h1>
			<?php }else{ ?>
			<br />
			<div style = "font-size:16px; color:#cc0000;"><?php echo isset($error) ? utf8_decode($error) : '' ; ?></div>
			
		<?php } ?>
		</center>
	</body>
	
</html>