<!--   Proyecto: Desarrollo de sistema para registro de empleados
       Empresa: Software S.A
       Proceso: El logueo de usuario
       Recursos: Mera Pedro, Luis Correa, Anabelle Gonzales, Jessica Martinez, Alvarado Angie
-->


<?php
// Inicializar la sesión
session_start();

// Compruebe si el usuario ya ha iniciado sesión, si es así, rediríjalo a la página de bienvenida
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: menu.php");
  exit;
}

// Incluir archivo de configuración
require_once "../../conexion/conexion.php";



// Definir variables e inicializar con valores vacíos
$username = $password = "";
$username_err = $password_err = "";

// Procesando los datos del formulario cuando se envía el formulario
if($_SERVER["REQUEST_METHOD"] == "POST"){

  /// Comprobar si el nombre de usuario está vacío
  if(empty(trim($_POST["username"]))){
    $username_err = "Por favor ingrese su usuario.";
} else{
    $username = trim($_POST["username"]);
}

// Comprobar si la contraseña está vacía
 if(empty(trim($_POST["password"]))){
  $password_err = "Por favor ingrese su contraseña.";
} else{
  $password = trim($_POST["password"]);
}

// Validar credenciales
if(empty($username_err) && empty($password_err)){
  // Preparar una declaración de selección
  $sql = "SELECT id, username, password FROM users WHERE username = ?";
  
  if($stmt = mysqli_prepare($conn, $sql)){
      // Vincular variables a la declaración preparada como parámetros
      mysqli_stmt_bind_param($stmt, "s", $param_username);
      
      // Establecer parámetros
      $param_username = $username;
      
      // Intento de ejecutar la sentencia preparada
      if(mysqli_stmt_execute($stmt)){
          // Store result
          mysqli_stmt_store_result($stmt);
          
          // Verifique si existe el nombre de usuario, si es así, verifique la contraseña
          if(mysqli_stmt_num_rows($stmt) == 1){                    
              // Vincular variables de resultado
              mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
              if(mysqli_stmt_fetch($stmt)){
                  if(password_verify($password, $hashed_password)){
                      // La contraseña es correcta, inicie una nueva sesión
                      session_start();
                      
                      // Almacenar datos en variables de sesión
                      $_SESSION["loggedin"] = true;
                      $_SESSION["id"] = $id;
                      $_SESSION["username"] = $username;                            
                      
                      // Redirigir a la usuario a la página de bienvenida
                      header("location: menu.php");
                  } else{
                      // Mostrar un mensaje de error si la contraseña no es válida
                      $password_err = "La contraseña que has ingresado no es válida.";
                  }
              }
          } else{
              // Mostrar un mensaje de error si el nombre de usuario no existe
              $username_err = "No existe cuenta registrada con ese nombre de usuario.";
          }
      } else{
          echo "Algo salió mal, por favor vuelve a intentarlo.";
      }
  }
  
  // Cerrar declaración
  mysqli_stmt_close($stmt);
}

// Cerrar Conenexion 
mysqli_close($conn);
}
?>

<!DOCTYPE html>
<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../../css/loginn.css">
    <link href="../../../Bootstrap5/css/bootstrap.min.css" rel="stylesheet" >
    <link href="../../../css/loginn.css" rel="stylesheet" type="text/css">
    <body>
<div class="container">
        <div class="row">
          <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card border-0 shadow rounded-3 my-5"><br>
             <div class="card-body p-4 p-sm-4">
                <img src="../../../img/logo instituto-01 (1).png" class="rounded mx-auto d-block" alt="10" width="200">
                <h5 class="card-title text-center mb-5 fw-light fs-5">Inico de secion</h5>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                 
                  <div class="form-floating mb-3 <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>")>
                   <label for="usuario" class="form-label">usuario</label>
                   <br>
                   <input type="usuario" class="form-control" name="username" value="<?php echo $username; ?>" >
                   <span class="help-block"><?php echo $username_err; ?></span>
                  </div>
                  <div class="form-floating mb-3 <?php echo (!empty($password_err))?  'has-error' : ''; ?>">
                    <label for="password" class="form-label">Password</label>
                    <br>                    <input type="password" class="form-control" name="password" id="floatingInput">
                    <span class="help-block"><?php echo $password_err; ?></span>
                  </div>
                  <hr class="my-4">
                  <div class="d-grid">
                    <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit"value="Ingresar">INGRESAR</button>
                  </div>
                  <br>
                  <div class="d-grid">
                    <a href="registro2.php" class="btn btn-danger " tabindex="-0" role="button" aria-disabled="true">REGISTRAR</a>
                  </div> 
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script src="../../../Bootstrap5/js/bootstrap.bundle.min.js"></script>
    </body>