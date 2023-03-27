<!--   Proyecto: Desarrollo de sistema para registro de empleados
       Empresa: Software S.A
       Proceso: Menu en cual se despliega las diferentes acciones 
       Recursos:  Mera Pedro, Luis Correa, Anabelle Gonzales, Jessica Martinez, Alvarado Angie
-->
<?php

// Inicializar la sesión
session_start();
 
// Verifique si el usuario ha iniciado sesión, si no, rediríjalo a la página de inicio de sesión
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Gestion Documental</title>
<body>
     <link href="../../../Bootstrap5/css/bootstrap.min.css" rel="stylesheet" >  
     <link href="../../../css/menu.css" rel="stylesheet" type="text/css">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" >
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" rel="stylesheet" >
     <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" rel="stylesheet" >
     <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet" >
     
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
     <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

<script>   
$(document).ready(function(){
  $("a").click(function(){
    $("#crear").load("../crud/consulta.php");
  });
});

$(document).ready(function(){
  $("b").click(function(){
    $("#menu").load("../documento/consultar.php");
  });
});
</script>
 
     
     <body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
       
    </header>
    <div class="l-navbar" id="nav-bar" id="crear" >
        <nav class="nav"> 
            <div > <a href="" class="nav_logo"> </i> <span class="nav_logo-name">Bienvenido <?php echo htmlspecialchars($_SESSION["username"]); ?></span> </a>
                <div  class="nav_list"> <a  href="../crud/crear.php" class="nav_link active"> <i class='bx bx-grid-alt nav_icon'></i>
                <span  class="nav_name">Registro</span> </a> 
                <a href="../crud/consulta.php" class="nav_link"> <i class='bx bx-user nav_icon'></i> 
                <span class="nav_name">Usurios</span> </a> 
                <a href="../reporte/fpdf/Reporte.php" class="nav_link"> <i class='bx bx-bookmark nav_icon'></i> 
                <span class="nav_name">Reporte</span> </a> 
                <a href="../documento/consultar.php" class="nav_link"> <i class='bx bx-folder nav_icon'></i> 
                <span class="nav_name">Carga Documento</span> </a> 
                <a href="restablecer.php" class="nav_link"> <i class='bx bx-bar-chart-alt-2 nav_icon'></i> 
                <span class="nav_name">Cambiar Contraseña</span> </a></div>
            </div> <a href="logout.php" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">Salir</span> </a>
        </nav>
       
    </div>
    <!--Inicio principal del contenedor-->
    <div class="height-100 bg-light"
   >
        <h4>Main Comhhgghonents</h4>
    </div>
    
<!--Extremo principal del contenedor-->
    <script src="../../../js/menu.js"></script>
    
</body>
</html><i class="fas fa-lock-open"></i>


