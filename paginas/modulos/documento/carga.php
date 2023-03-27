<!--   Proyecto: Desarrollo de sistema para registro de empleados
       Empresa: Software S.A
       Proceso: El logueo de usuario
       Recursos://
-->

<?php

$id= $_GET['id'];

?>

<?php 
    $id=$_GET['id'];
    include "../../conexion/conexion.php";
    $conn();
    $datos($conn,$id);
    $curriculo=$datos['curriculo'];
    $url=$datos['url'];
    header("Content-Disposition:inline;filename=$curriculo.$url");
    echo $archivo;
?>