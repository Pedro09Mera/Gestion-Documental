<!--   Proyecto: Desarrollo de sistema para registro de empleados
       Empresa: Software S.A
       Proceso: El usuario podra cambiar sun contraseña
       Recursos:Mera Pedro, Luis Correa, Anabelle Gonzales, Jessica Martinez, Alvarado Angie
-->

<?php

// Inicializar la sesión
session_start();
 
// Comprobar si el usuario ha iniciado sesión, de lo contrario redirigir a la página de inicio de sesión
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
// Incluir archivo de configuración
require_once "../../conexion/conexion.php";
 
// Definir variables e inicializar con valores vacíos
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
// Procesando los datos del formulario cuando se envía el formulario
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validar nueva contraseña
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Por favor, introduzca la nueva contraseña.";     
    } elseif(strlen(trim($_POST["new_password"])) < 5){
        $new_password_err = "La contraseña al menos debe tener 5 caracteres.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    
// Validar confirmar contraseña
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Por favor confirme la contraseña.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Las contraseñas no coinciden.";
        }
    }
        
    // Comprobar errores de entrada antes de actualizar la base de datos
    if(empty($new_password_err) && empty($confirm_password_err)){
       
        // Preparar una declaración de actualización
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Vincular variables a la declaración preparada como parámetros
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            // Establecer parámetros
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // Intento de ejecutar la sentencia preparada
            if(mysqli_stmt_execute($stmt)){
                // Contraseña actualizada exitosamente. Destruir la sesión y redirigir a la página de inicio de sesión
                session_destroy();
                header("location: login.php");
                exit();
            } else{
                echo "Algo salió mal, por favor vuelva a intentarlo.";
            }
        }
        
        // Cerrar declaración
        mysqli_stmt_close($stmt);
    }
    
    // Conexión cercana
    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<head>
    <title>Cambio de Contraseña</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../../../Bootstrap5/css/bootstrap.min.css" rel="stylesheet" >
    <link href="../../../css/loginn.css" rel="stylesheet" type="text/css">
    <body>
<div class="container">
        <div class="row">
          <div class="col-sm-9 col-md-7 col-lg-5 mx-auto"><br><br><br><br><br>
            <div class="card border-0 shadow rounded-3 my-5">
             <div class="card-body p-4 p-sm-4">
             <h2>Deseas Cambiar la contraseña?</h2>
        <p>Complete este formulario para cambiar su contraseña.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <label>Nueva contraseña</label>
                <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
                <span class="help-block"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirmar contraseña</label>
                <input type="password" name="confirm_password" class="form-control">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-danger" value="Enviar">
                <a class="btn btn-link" href="menu.php">Cancelar</a>
            </div>
        </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script src="../../../Bootstrap5/js/bootstrap.bundle.min.js"></script>
    </body>