<!--   Proyecto: Desarrollo de sistema para registro de empleados
       Empresa: Software S.A
       Proceso: Registrar a los usuarios para luego inicar seccion 
       Recursos:Mera Pedro, Luis Correa, Anabelle Gonzales, Jessica Martinez, Alvarado Angie
-->
<?php
// Incluir archivo de configuración
require_once "../../conexion/conexion.php";
 
// Definir variables e inicializar con valores vacíos
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Procesando los datos del formulario cuando se envía el formulario
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validar nombre de usuario
    if(empty(trim($_POST["username"]))){
        $username_err = "Por favor ingrese un usuario.";
    } else{
        // Preparar una declaración de selección
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Vincular variables a la declaración preparada como parámetros
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Establecer parámetros
            $param_username = trim($_POST["username"]);
            
            // Intento de ejecutar la sentencia preparada
            if(mysqli_stmt_execute($stmt)){
                /* almacenar resultado */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Este usuario ya fue tomado.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Al parecer algo salió mal.";
            }
        }
         
        // Cerrar declaración
        mysqli_stmt_close($stmt);
    }
    
    
   // Validar contraseña
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor ingresa una contraseña.";     
    } elseif(strlen(trim($_POST["password"])) < 5){
        $password_err = "La contraseña al menos debe tener 5 caracteres.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validar confirmar contraseña
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Confirma tu contraseña.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "No coincide la contraseña.";
        }
    }
    
    // Comprobar errores de entrada antes de insertar en la base de datos
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Preparar una declaración de inserción
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Vincular variables a la declaración preparada como parámetros
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Establecer parámetros
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Crea un hash de contraseña
            
            // Intento de ejecutar la sentencia preparada
            if(mysqli_stmt_execute($stmt)){
                // Redirigir a la página de inicio de sesión
                header("location: login.php");
            } else{
                echo "Algo salió mal, por favor inténtalo de nuevo.";
            }
        }
         
        
// Cerrar sentencia
        mysqli_stmt_close($stmt);
    }
    
    
// Conexión cercana
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registar</title>
    <link href="../../../Bootstrap5/css/bootstrap.min.css" rel="stylesheet" >
    <link href="../../../css/registrar.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="signup-form">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h2>Registrar</h2>
            <p class="hint-text">Registro de datos</p>
             
             <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
             <label>usuario</label>
             <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
             <span class="help-block"><?php echo $username_err; ?></span>
             </div>

             <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
             <label>CONTRASEÑA</label>
             <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
             <span class="help-block"><?php echo $password_err; ?></span>
             </div>

             <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
             <label>COMFIRMAR CONTRASEÑA</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>

             <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Ingresar">
                <input type="reset" class="btn btn-default" value="Borrar">
             </div>
             <p>¿Ya tienes una cuenta? <a href="login.php">Ingresa aquí</a>.</p>
        </form>
    </div>
    <script src="../../../js/alerta_registrar.js"></script>
    <script src="../../../Bootstrap5/js/bootstrap.bundle.min.js"></script>
</body>
</html>