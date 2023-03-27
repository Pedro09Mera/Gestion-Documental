<!--   Proyecto: Desarrollo de sistema para registro de empleados
       Empresa: Software S.A
       Proceso: Parte logica para subir archivos 
       Recursos: Mera Pedro, Luis Correa, Anabelle Gonzales, Jessica Martinez, Alvarado Angie
-->

<?php

include "../../conexion/conexion.php";

if($_POST['subir']){
    if(file_exists($_FILES['archivo']['tmp_name'])){
        if(move_uploaded_file($_FILES['archivo']['tmp_name'], 'docu-enviados/'.$_FILES['archivo']['name']));

        $url ='docu-enviados/'.$_FILES['archivo']['name'];
        $nombre = $_POST['nombre'];
        $id= $_GET['id'];
        $sql = $conn->query("INSERT INTO documento (curriculo,url) VALUES('".$nombre."','".$url."')");
        header("location: consultar.php");
        }else{
            echo"no subido";
        } 
         }     

?>