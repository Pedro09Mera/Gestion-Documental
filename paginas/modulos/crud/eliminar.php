<!--   Proyecto: Desarrollo de sistema para registro de empleados
       Empresa: Software S.A
       Proceso: Eliminar empleados
       Recursos: Mera Pedro, Luis Correa, Anabelle Gonzales, Jessica Martinez, Alvarado Angie
-->

<?php
// Procesar la operación de eliminación después de la confirmación
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Include config file
    require_once "../../conexion/conexion.php";
    
    // Preparar una sentencia de eliminación sql
    $sql = "DELETE FROM empleado WHERE id = ?";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        // Vincular variables a la declaración preparada como parámetros
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Establecer parámetros
        $param_id = trim($_POST["id"]);
        
        // Intento de ejecutar la sentencia preparada
        if(mysqli_stmt_execute($stmt)){
            // Registros eliminados con éxito. Redirigir a la página de destino
            header("location: consulta.php");
            exit();
        } else{
            echo "¡Ups! Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
        }
    }
     
    // Cerrar declaración
    mysqli_stmt_close($stmt);
    
    // cerrar conexion
    mysqli_close($conn);
} else{
    // Comprobar la existencia del parámetro id
    if(empty(trim($_GET["id"]))){
        // La URL no contiene el parámetro id. Redirigir a la página de error
        header("location: error.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Borrar</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
    <script>
    
    $(document).ready(function(){
      $("#cp").click(function(){
         var nombre =  document.getElementById('colFormLabelLg1').value;
         var precio =   document.getElementById('colFormLabelLg2').value;
         var fabricante =   document.getElementById('colFormLabelLg3').value;
         $("#area_dinamica").load("crear_productos2.php?nombre"+nombre+"&precio="+precio+"&fabricante="+fabricante);
      });
      $("#ce").click(function(){
        $("#area_dinamica").load("consulta_producto.php");
      });
    });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Borrar Registro</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden"name="id"  value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Está seguro que deseas borrar el registro</p><br>
                            <p>
                                <input type="submit" value="Si" class="btn btn-danger">
                                <a href="Consulta.php" class="btn btn-default">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>