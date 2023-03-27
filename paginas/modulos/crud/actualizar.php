<!--   Proyecto: Desarrollo de sistema para registro de empleados
       Empresa: Software S.A
       Proceso: Proceso para actaulizar registro de la tabla empleado 
       Recursos:  Mera Pedro, Luis Correa, Anabelle Gonzales, Jessica Martinez, Alvarado Angie
-->

<?php
// Incluir archivo de configuración
require_once "../../conexion/conexion.php";
 
// Define variables and initialize with empty values
$nombre = $direccion = $sueldo = $edad = $email = $tipo_sangre = $departamento = "";
$nombre_err = $direccion_err = $sueldo_err =  $edad_err = $email_err = $tipo_sangre_err = $departamento_err = "";
 
// Procesando los datos del formulario cuando se envía el formulario
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    // Validar nombre
        $input_nombre = trim($_POST["nombre"]);
        if(empty($input_nombre)){
            $nombre_err = "Por favor ingrese el nombre del empleado.";
        } elseif(!filter_var($input_nombre, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
            $nombre_err = "Por favor ingrese un nombre válido.";
        } else{
            $nombre = $input_nombre;
        }
        
      // Validar dirección
        $input_direccion = trim($_POST["direccion"]);
        if(empty($input_direccion)){
            $direccion_err = "Por favor ingrese una dirección.";     
        } else{
            $direccion = $input_direccion;
        }
        
        // Validar sueldo
        $input_sueldo = trim($_POST["sueldo"]);
        if(empty($input_sueldo)){
            $salary_err = "Por favor ingrese el monto del sueldo del empleado.";     
        } elseif(!ctype_digit($input_sueldo)){
            $salary_err = "Por favor ingrese un valor correcto y positivo.";
        } else{
            $salary = $input_sueldo;
        }
         
        // Validar edad
        $input_edad = trim($_POST["edad"]);
        if(empty($input_edad)){
            $edad_err = "Por favor ingrese su edad.";     
        } else{
            $edad = $input_edad;
        }
    
        // Validar email
        $input_email = trim($_POST["email"]);
        if(empty($input_email)){
            $email_err = "Por favor ingrese un email.";     
        } else{
            $email = $input_email;
        }
    
        // Validar tipo de sangre
        $input_tipo_sangre = trim($_POST["tipo_sangre"]);
        if(empty($input_tipo_sangre)){
            $tipo_sangre_err = "Por favor ingrese su tipo de sangre.";     
        } else{
            $tipo_sangre = $input_tipo_sangre;
        }
        
        // Validar el departamento que pertenece el empleado
        $input_departamento = trim($_POST["departamento"]);
        if(empty($input_departamento)){
            $departamento_err =  "Por favor ingrese al departamento que pertenes ejemplo SISTEMA.";     
        } else{
            $departamento = $input_departamento;
        }
    
    
    // Comprobar errores de entrada antes de insertar en la base de datos
    if(empty($nombre_err) && empty($direccion_err) && empty($sueldo_err) && empty($edad_err) && empty($email_err) && empty($tipo_sangre_err) && empty($departamento_err)){
        // Preparar una declaración de inserción
        $sql = "UPDATE empleado  SET nombre=?, direccion=?, sueldo=?, edad=?, email=?, tipo_sangre=?  , departamento=? WHERE id=?";
      
        if($stmt = mysqli_prepare($conn, $sql)){
            // Vincular variables a la declaración preparada como parámetros
            mysqli_stmt_bind_param($stmt, "sssssssi", $param_nombre, $param_direccion, $param_sueldo,  $param_edad, $param_email, $param_tipo_sangre, $param_departamento, $param_id);
            
            // Establecer parámetros
            $param_nombre = $nombre;
            $param_direccion = $direccion;
            $param_sueldo = $sueldo;
            $param_edad = $edad;
            $param_email = $email;
            $param_tipo_sangre = $tipo_sangre;
            $param_departamento = $departamento;
            $param_id = $id;
            
            // Intento de ejecutar la sentencia preparada
            if(mysqli_stmt_execute($stmt)){
                // Registros actualizados con éxito. Redirigir a la página de destino
                header("location: consulta.php");
                exit();
            } else{
                echo "Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
            }
        }
         
        // Cerrar sentencia
        mysqli_stmt_close($stmt);
    }
    
    // Cerrar Conexion
    mysqli_close($conn);
} else{
    // Comprobar la existencia del parámetro id antes de seguir procesando
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Obtener parámetro de URL
        $id =  trim($_GET["id"]);
        
        // Preparar sentencia de seleccion
        $sql = "SELECT * FROM empleado WHERE id = ?";
        if($stmt = mysqli_prepare($conn, $sql)){
            // Vincular variables a la declaración preparada como parámetros
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Establecer parámetros
            $param_id = $id;
            
            // Intento de ejecutar la sentencia preparada
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Obtiene la fila de resultados como una matriz asociativa. Dado que el conjunto de resultados
                    contiene solo una fila, no necesitamos usar while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Recuperar valor de campo individual
                    $nombre = $row["nombre"];
                    $direccion = $row["direccion"];
                    $sueldo =$row["sueldo"];
                    $edad = $row["edad"];
                    $email =$row["email"];
                    $tipo_sangre = $row["tipo_sangre"];
                    $departamento = $row["departamento"];
                } else{
                    // La URL no contiene una identificación válida. Redirigir a la página de error
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "ops! Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
            }
        }
    
        
        // Cerrar sentencia
        mysqli_stmt_close($stmt);
        
        // Cerrar conexion
        mysqli_close($conn);
  
}
}
?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
	<title>Registar Empleado</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="../../../img/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="../../../vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../../../vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="../../../vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="../../../vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="../../../css/util.css">
	<link rel="stylesheet" type="text/css" href="../../../css/main.css">
</head>
<body>

	<div class="contact1">
		<div class="container-contact1">
			<div class="contact1-pic js-tilt" data-tilt>
				<img src="../../../img/img-01.png" alt="IMG">
			</div>

			<form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
				<span class="contact1-form-title">
					Actualizar Registro 
				</span>

                <p>Edite los valores de entrada y envíe para actualizar el registro</p>
                 <br>
				<div class="form-group <?php echo (!empty($nombre_err)) ? 'has-error' : ''; ?>">
					<input class="input1" type="text" name="nombre" placeholder="Nombre"<?php echo $nombre; ?>>
					<span class="help-block"><?php echo $nombre_err;?></span>
				</div>
                
				<div class="form-group <?php echo (!empty($direccion_err)) ? 'has-error' : ''; ?>">
					<input class="input1" type="text" name="direccion" placeholder="Dirección"<?php echo $direccion; ?>>
					<span class="help-block"><?php echo $direccion_err;?></span>
				</div>

				<div class="form-group <?php echo (!empty($sueldo_err)) ? 'has-error' : ''; ?>">
					<input class="input1" type="text" name="sueldo" placeholder="sueldo" value="<?php echo $sueldo; ?>">
					<span class="help-block"><?php echo $sueldo_err;?></span>
				</div>

                <div class="form-group <?php echo (!empty($edad_err)) ? 'has-error' : ''; ?>">
					<input class="input1" type="text" name="edad" placeholder="edad"<?php echo $edad; ?>>
					<span class="help-block"><?php echo $edad_err;?></span>
				</div>

				<div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
					<input class="input1" type="text" name="email" placeholder="Email" <?php echo $email; ?>>
					<span class="help-block"><?php echo $email_err;?></span>
				</div>

                <div class="form-group <?php echo (!empty($tipo_sangre_err)) ? 'has-error' : ''; ?>">
					<input class="input1" type="text" name="tipo_sangre" placeholder="Tipo de Sangre"<?php echo $tipo_sangre; ?>>
					<span class="help-block"><?php echo $tipo_sangre_err;?></span>
				</div>

                <div class="form-group <?php echo (!empty($departamento_err)) ? 'has-error' : ''; ?>">
					<input class="input1" type="text" name="departamento" placeholder="Departamento" <?php echo $departamento; ?>>
					<span class="help-block"><?php echo $departamento_err;?></span>
				</div>
                
				<input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Enviar">
                        <a href="consulta.php" class="btn btn-default">Cancelar</a>
						
					</button>
				</div>
			</form>
		</div>
	</div>





	<script src="../../../vendor/jquery/jquery-3.2.1.min.js"></script>

	<script src="../../../vendor/bootstrap/js/popper.js"></script>
	<script src="../../../vendor/bootstrap/js/bootstrap.min.js"></script>

	<script src="../../../vendor/select2/select2.min.js"></script>

	<script src="../../../vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>


	<script src="../../../js/main.js"></script>

</body>
</html>
