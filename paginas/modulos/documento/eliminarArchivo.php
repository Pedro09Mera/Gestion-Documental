<!--   Proyecto: Desarrollo de sistema para registro de empleados
       Empresa: Software S.A
       Proceso: Ekiminar archivo 
       Recursos: Mera Pedro, Luis Correa, Anabelle Gonzales, Jessica Martinez, Alvarado Angie
-->

<?php
require '../../conexion/conexion.php';
 
$id = $_GET["id"];
 
 $sql = "DELETE FROM documento WHERE id='$id'";
 $resultado = $conn->query($sql);

 $conn->close();
?>
<html lang="es">
	<head>
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-theme.css" rel="stylesheet">
		<script src="js/jquery-3.1.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>	
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
         }
       </style>
  
	</head>
	
	<body>
     <div class="wrapper">
	
			<div class="row">
				<div class="row" style="text-align:center"><br><br><br><br><br><br><br><br><br>
                <div class="alert alert-danger fade in">
				<?php if($resultado) { ?>
				<h3>REGISTRO ELIMINADO CON EXITO</h3>
				<?php } else { ?>
				<h3>ERROR AL ELIMINAR</h3>
				<?php } ?>
				<p>El registro se a elimando correctamente</p><br>
                <p>
                    <a href="Consultar.php" class="btn btn-danger">REGRESAR</a>
                </p>
				</div>
		</div>
        </div>
        </div>
     
	</body>
</html>




