<!--   Proyecto: Desarrollo de sistema para registro de empleados
       Empresa: Software S.A
       Proceso: Parte donde se me muestra todos los registro 
       Recursos: Mera Pedro, Luis Correa, Anabelle Gonzales, Jessica Martinez, Alvarado Angie
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Consultar</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap -->
    
    


    <style type="text/css">
        html,
        body {
            height: 100%;
            width: 80%;
        }

        button#user-topnav-menu {
            background: #FF3933;
            border: 1px solid #b1b1b1;
            padding: 0.2em 2em;
            text-align: left !important;
            border-radius: 2em;
        }

        @media print {

            .col-lg-6,
            .col-md-6 {
                width: 50%;
            }

            .lh-1 {
                line-height: 1em;
            }
        }
   
        .wrapper{
            width: 650px;
            margin: 0 auto;
          
        }
        .page-header h2{
            margin-top: 0;
            color: blue
        }
        table tr td:last-child a{
            margin-right: 15px;
            margin-inline-start: 500 0pxx; 
           
        }
        .wrapper{
            border-collapse: separate;
        }
    </style>

<script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    
    $(document).ready(function(){   
    $("#addempleado").click(function(){
      $("#crear").load("../crud/crear.php");
    });

    $(document).click(function(){
        var collection = document.getElementsByTagName("udp");
        alert(collection.length)
    
    });
     $("#del").click(function(){
      $("#crear").load("../crud/eliminar.php");
    });
    
  });
   
    </script>
</head>
<body >
    <div  class="wrapper" >
    <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                <div class="page-header clearfix">
                <a href="../login/menu.php" class="btn btn-success border btn- btn-lg" > REGRESAR  </a><br><br><br>
                        <h2>Usuarios registrados</h2>
                        </div>
                        <div  class=" ">
                        
                        <div class="text-right mb-2">
                            <a href="../crud/crear.php" id="addempleado" class="btn btn-danger pull-right">Agregar nuevo empleado</a> <br><br><br>

                            <a href="../reporte/fpdf/Reporte.php" target="_blank" class="btn btn-primary pull-right"><i class="fas fa-file-pdf"></i> Generar Reporte</a><br><br><br>
                            
                        </div>
                    <?php
                    //<!--<a href="crear.php" class="btn btn-success pull-right">Agregar nuevo empleado</a><img src="../../../img/logo instituto-01 (1).png" height="500">––>
                    // Include config file
                    include "../../conexion/conexion.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM empleado";
                    if($result = mysqli_query($conn, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>ID</th>";
                                        echo "<th>NOMBRE</th>";
                                        echo "<th>DIRECCION</th>";
                                        echo "<th>Sueldo</th>";
                                        echo "<th>EDAD</th>";
                                        echo "<th>CORREO ELECTRONICO</th>";
                                        echo "<th>TIPO DE SANGRE</th>";
                                        echo "<th>DEPARTAMENTO</th>";
                                        echo "<th>Acción</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['nombre'] . "</td>";
                                        echo "<td>" . $row['direccion'] . "</td>";
                                        echo "<td>" . $row['sueldo'] . "</td>";
                                        echo "<td>" . $row['edad'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['tipo_sangre'] . "</td>";
                                        echo "<td>" . $row['departamento'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='leer.php?id=". $row['id'] ."' title='VER EMPLEADO' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='actualizar.php?id=". $row['id'] ."' title='ACTUALIZAR EMPLEADO' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='eliminar.php?id=". $row['id'] ."' title='ELIMINAR EMPLEADO' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No existen registros .</em></p>";
                        }
                    } else{
                        echo "ERROR: No se pudo ejecutar $sql. " . mysqli_error($conn);
                    }
 
                    // Close connection
                    mysqli_close($conn);
                    ?>
                </div>
            </div>  
            </div>      
        </div>
        </div>
    </div>
</body>
</html>