<!--   Proyecto: Desarrollo de sistema para registro de empleados
       Empresa: Software S.A
       Proceso: Se muestra todo los registros ingresados
       Recursos: Mera Pedro, Luis Correa, Anabelle Gonzales, Jessica Martinez, Alvarado Angie
-->

<?php
// Comprobar la existencia del parámetro id antes de seguir procesando
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    include "../../conexion/conexion.php";
    
    /// Preparar una sentencia de seleccioo
    $sql = "SELECT * FROM empleado WHERE id = ?";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        // Vincular variables a la declaración preparada como parámetros
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Establecer parámetros
        $param_id = trim($_GET["id"]);
        
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
                $sueldo = $row["sueldo"];
                $edad = $row["edad"];
                $email = $row["email"];
                $tipo_sangre = $row["tipo_sangre"];
                $departamento = $row["departamento"];
            } else{
                // La URL no contiene un parámetro de identificación válido. Redirigir a la página de error
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "¡Ups! Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
        }
    }
     
    // Cerrar declaración
    mysqli_stmt_close($stmt);
    
    // Cerrar conexion
    mysqli_close($conn);
} else{
    // La URL no contiene el parámetro id. Redirigir a la página de error
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../../../Bootstrap5/css/bootstrap.min.css" rel="stylesheet" >
    <link href="../../../css/loginn.css" rel="stylesheet" type="text/css">
    <body>
<div class="container">
        <div class="row">
          <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card border-0 shadow rounded-3 my-5">
             <div class="card-body p-4 p-sm-4">
                <h5 class="card-title text-center mb-5 fw-light fs-5">Ver empleado</h5>
                <div class="form-group">
                        <label>Nombre</label>
                        <p class="form-control-static"><?php echo $row["nombre"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Dirección</label>
                        <p class="form-control-static"><?php echo $row["direccion"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Sueldo</label>
                        <p class="form-control-static"><?php echo $row["sueldo"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Edad</label>
                        <p class="form-control-static"><?php echo $row["edad"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <p class="form-control-static"><?php echo $row["email"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Tipo de sangre</label>
                        <p class="form-control-static"><?php echo $row["tipo_sangre"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Departamento</label>
                        <p class="form-control-static"><?php echo $row["departamento"]; ?></p>
                    </div>
                    <p><a href="consulta.php" class="btn btn-primary">Volver</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script src="../../../Bootstrap5/js/bootstrap.bundle.min.js"></script>
    </body>