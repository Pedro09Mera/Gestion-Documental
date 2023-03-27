<!--   Proyecto: Desarrollo de sistema para registro de empleados
       Empresa: Software S.A
       Proceso: Inicio de Seccion 
       Recursos:Mera Pedro, Luis Correa, Anabelle Gonzales, Jessica Martinez, Alvarado Angie
-->

<?php

// Inicializar la sesión
session_start();
 
// Unset all of the session variables
$_SESSION = array();
 

// Desarmar todas las variables de sesión
session_destroy();
 
// Redirigir a la página de inicio de sesión
header("location: login.php");
exit;
?>