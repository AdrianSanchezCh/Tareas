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
        <meta charset = "UTF-8">
		<title>Actualizar Registros</title>
		<link href = "css/login.css" rel = "stylesheet" type = "text/css">
		<script type="text/javascript" src="js/jquery.js"></script>
		
	</head>
	
	<body background="fondo.jpg " >
		
		
		<center>
		<div class="menuadmin" ><img src="imges_DV/NewLogo.png" width="200px" height="200px" />
		<form  class="buscarp" name="buscarp" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" > 
			<fieldset > <legend>Buscar Producto</legend>
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
    <form>
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
        </form>


		</div>
		 </section>
		</center>
		</div>
		

		
		<center>
                <form class="menuadmin" id="actualizar" name="actualizar" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" > 
            <fieldset > <legend>Actualizar </legend>
                    <br>
                    <div><label>SKU para Actualizar</label>
                        <select id="updatesku" name="updatesku">
                            <option value="">SKU</option>
                            <?php
                                                             
                                $con=mysql_query("SELECT * FROM postres");
                                $reg=mysql_fetch_array($con);


                                do{
                                    $skuup=$fila['SKU'];
                                    
                            ?>
                            <option value="<?php echo $skuup ?> ">   <?php echo $skuup ?>   </option>
                            <?php

                                }while ($fila = $result->fetch_assoc());
                                    
                            ?>

                        </select>
                        <br>
                    </div>
                    <div><label>Tipo</label>
                        <select id="tipo_producto" name="tipo_producto">
                            <option value="">Tipo de Producto:</option>
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
                
                <div><input id="registrop" name="registrarp" type="button" value="Actualizar" onClick="validar();">

                <a href="admin.php" target="_self"> <input type = "button" id="invited" name = "invited" value="Regresar"></div> 



            </fieldset>
            <div class="subindice">Nomenclatura:<br>CK_: Cupcake|  Chk_: Chessecake|  Pst_: Pastel|  Fn_: Flan|  Cn_: Conos|  Mz_: Manzanas</div>
        </form>





        </center>
		
	</body>
	
</html>