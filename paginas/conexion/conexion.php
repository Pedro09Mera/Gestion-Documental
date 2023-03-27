<!--   Proyecto: Desarrollo de sistema para registro de empleados
       Empresa: Software S.A
       Proceso: El logueo de usuario
       Recursos://
-->
<?php

$servername = "localhost";
$username = "root";
$password = "root1234";
$dbname = "gestion_documental";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}else {
  //echo "Conexion Correcta....!!!";
}


?>

