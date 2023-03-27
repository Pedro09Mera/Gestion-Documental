<!--   Proyecto: Desarrollo de sistema para registro de empleados
       Empresa: Software S.A
       Proceso: Parte donde se me muestra todos los registro 
       Recursos: Mera Pedro, Luis Correa, Anabelle Gonzales, Jessica Martinez, Alvarado Angie
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>	
    <title>Carga de documento</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        html,
        body {
            height: 100%;
            width: 100%;
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
    </style>
</head>
<body class="bg-dark bg-gradient bg-opacity-25">
    <div class="container py-4">
        <h1 class="text-center fw-bold">Subir Archivos Con sus nombres</h1>
        <hr>
            <div class="alert alert-success rounded-0">
            </div>
<div class="clear-fix py-2" ></div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                <div class="card rounded-0 shadow">
                    <div class="card-header">
                        <div class="card-title h4 mb-0 fw-bold">Formulario de Subida de Archivos</div>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <form action="subir.php" method="POST" id="file-upload" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="label" class="control-label">Nombre del Archivo</label>
                                    <input type="text" name="nombre" id="label" class="form-control rounded-0">
                                </div>
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Archivo</label>
                                    <input class="form-control rounded-0" name="archivo" type="file" id="formFile">
                                </div>
                               
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button title="GUARDAR"  name="subir" class="btn btn-primary btn-sm bg-gradient rounded-0" form="file-upload" type="submit" name="subir" value="enviar"><i class="fa fa-save"></i> Guardar Archivo</button> <br><br>
                        <button title="RESETEAR" class="btn btn-warning border btn-sm bg-gradient rounded-0" type="reset" form="file-upload"><i class="fa fa-times"></i> Resetear Campos</button><br><br>
                        <a href="../login/menu.php" class="btn btn-success border btn- btn-lg" > REGRESAR  </a>
                    </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12">
                <div class="card rounded-0 shadow">
                    <div class="card-header">
                        <div class="card-title h4 mb-0 fw-bolder">Archivos Subidos</div>
                    </div>
                   
                    <div class="card-body">
                        <div class="container-fluid">
                        <?php
                   
                            include('../../conexion/conexion.php');

                          $documento = $conn->query("SELECT documento.`id`,documento.`curriculo`,documento.`url` FROM documento");
                          ?>
                            <table class="table table-striped table-bordered">
                                <colgroup>
                                    <col width="10%">
                                    <col width="20%">
                                    <col width="50%">
                                    <col width="20%">
                                </colgroup>
                                <thead>
                                    <tr class="bg-primary bg-gradient text-light">
                                        <th class="p-1 text-center">ID</th>
                                        <th class="p-1 text-center">Nombre</th>
                                        <th class="p-1 text-center">Documento</th>
                                        <th class="p-1 text-center">Acciones</th>
                                
                                    </tr>
                                </thead>
                                <tbody>
                               
                                <tbody>
                                    <?php foreach ($documento as $documento){ ?>
                                    <?php 
                                    $rutaDescarga="docu-enviados/".$documento['id']."/".$documento['url'];
                                    $nombreArchivo = $documento['url']?>
                                   
                                    
                                    <tr>
                                        <td><?php echo $documento['id'] ?></td>
                                        <td><?php echo $documento['curriculo'] ?></td>
                                        <td><?php echo $documento['url'] ?></td>
                                        <td px-2 py-1 align-middle text-center>
                                        <?php ?>
                                       
                                            <a href="<?php echo $nombreArchivo ?>"
                                            download="<?php echo $rutaDescarga  ?>" title="DESCARGAR" class="btn btn-success btn-sm">
                                            <span class="fas fa-download"></span>
                                            </a>
                                            
                                            <a  href="eliminarArchivo.php?id=<?php echo $documento["id"]?> "   title="ELIMINAR"          
                                            class="btn btn-danger btn-sm"> 
                                            <span  class="fa-solid fa-trash"> </span>
                                            </a>
                                            <a href="<?= $documento['url'] ?>" class="btn btn-warning btn-sm"
                                             target="_blank" title="VER DOCUME"><i class="fa fa-external-link"></i></a>
                                             <br>

                                            
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    </table>
                                 	
                                </tbody>
                               