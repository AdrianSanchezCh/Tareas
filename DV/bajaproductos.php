<?php
	
	session_start();
	require 'conexion.php';
	
	if(!isset($_SESSION["id_usuario"])){
		header("Location: index.php");
	}
	
    $where="";
    
	//////////////////Boton Buscar ///////////////////////////////////
    if(isset($_POST['buscarp'])){
                         
              $xtipo=$_POST['tipo'];
              $where="where Tipo='".$xtipo."'";
          }
             
		
        //////////////////Conexion con la Bd postres//////////////////  
        $sqlBusqueda = "SELECT * FROM postres $where  ";
        $result=$mysqli->query($sqlBusqueda);
        

	
?>

<html>
	<head>
		<title>Registro</title>
		<link href = "css/login.css" rel = "stylesheet" type = "text/css">
		<script>
			
			
		</script>
		
	</head>
	
	<body background="fondo.jpg " >
		
		
		<center>
		<div class="menuadmin" ><img src="imges_DV/NewLogo.png" width="200px" height="200px" />
		<form  class="buscarp" name="buscarp" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" > 
			<fieldset > <legend>Baja de Producto</legend>
					<br>
					<div>
						<select  name="tipo">
							<option value="">Tipo de Producto</option>
							<option value="Cupcake" >Cupcake</option>
							<option value="Pastel" >Pastel</option>
							<option value="Flan" >Flan</option>
							<option value="Chessecake" >Chessecake</option>
							<option value="Otro" >Otro</option>
						</select>
                        
					</div>
					<br/>
				
				<div><button id="buscarp" type="submit" class="buscarp" name="buscarp"  >Buscar Productos </button><a class="menuadmin" href="admin.php" target="_self"> <input type = "button" id="invited" name = "invited" value="Regresar"></div></a>
			</fieldset>
		</form>
       </center>
      <section>
      <div>
      <center>
      	<table class="tabla"  border="2" cellpadding="3">
      		<tr>
              	<th>SKU    </th>
      			<th>Tipo   </th>
      			<th>Nombre     </th>
      			<th>Costo      </th>
      			<th>Piezas     </th>
      		</tr>
            
		<?php
           ////////// Creacion de la tabla con el contenido de la BD/////////////////
			while($fila = $result->fetch_assoc()) {
                 echo "<tr>

						<td>$fila[SKU]</td>
                        <td>$fila[Tipo]</td>
                        <td>$fila[Nombre]</td>
                        <td>$fila[Costo]</td>
                        <td>$fila[Piezas]</td>

                      </tr>";
			}
            
		 ?>
		 </table>
		</div>
		 </section>
		</center>
		</div>
		

		
		<center></center>
		
	</body>
	
</html>