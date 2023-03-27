<!-- Proyecto:Como usar botones con imágenes y tablas con Bootstrap
     Empresa: Pedro Mera
     Proceso:Practica De botones y tablas con boostrap y que una imagen se haga boton
     Recursos:Mera Pedro, Luis Correa, Anabelle Gonzales, Jessica Martinez, Alvarado Angie-->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inventario</title>
  <!--Link de boostrap para estilos css-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>  
<div class="contanier mt-3">
       <center>
      <h2>Inventario de Electrodoméstico</h2>
      <br>
      <br>
      <!--Creacion de tabla-->
      <table class="table">
        <thead>
          <tr>
            <th>Codigo</th>
            <th>Electrodomesticos</th>
            <th></th>
          </tr>
          </center>
          </thead>
             <tbody>
              <?php
             //Conxexion a Base de datos
             include("../../conexion/conexion.php");
             
             //Sentencia la cual nos muetsra el codigo y el nombre de los elctrodomesticos
              $sql = "SELECT codigo, nombre FROM producto";
              $result = mysqli_query($conn, $sql);
              
              if (mysqli_num_rows($result) > 0) {
                // Los datos de cada fila
                while($row = mysqli_fetch_assoc($result)) {
                  echo "<tr> <td>" . $row["codigo"]. "</td> <td> " . $row["nombre"]. "</td> <td> <button type='button' class='btn btn-primary'>Modificar</button> <button type='button' class='btn btn-warning'>Eliminar</button></td> <tr>";
                }
              } else {
                echo "0 results";
              }
              // Nos permite cerrar la conexion 
              mysqli_close($conn);
              ?>
             </tbody>
             </table>

             <!--Tenemos dos imagenes que al darle clip no enviara ala ruta especificada en href en este caso se puso el mismo login
             que al darle clip no enviras a un login se componentes de  boostrap5-->
             <a href="../login/login.html">
          <img img src="../../../img/102549693-thumb-up-i-like-it-yes-â€“-stock-vector.webp" class="img-thumbnail" width="100px" height="100px" alt="C" >
          </a> 
          <!--Nos lleva a conexion.php esta solo es practica un proyecto real no deve ir como se relizo-->
          <a href="../../conexion/conexion.php">
          <img img src="../../../img/50599228-pulgar-abajo-plana-de-color-verde-y-el-icono-de-círculo-verde.webp" class="img-thumbnail" width="100px" height="100px" alt="C" >
          </a>        
  </body>
</html>


 



