<?php

include_once "entidades/config.php";
include_once "entidades/cliente.php";
$pg = "Listado de clientes";

$cliente = new Cliente();
$aClientes =$cliente->obtenerTodos();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
<!-- Page Wrapper -->
<div id="wrapper">
    <?php include 'menu.php';?>    
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Listado de ventas</h1>
            <a href="cliente-formulario.php" class="btn btn-primary mr-2 mb-2">Nuevo</a>
            <table class="table table-hover">           
                    <tr>
                        <th>CUIT</th>
                        <th>Nombre</th>
                        <th>Fecha nac.</th>
                        <th>Teléfono</th>            
                        <th>Correo</th>
                        <th>Domicilios</th>
                        <th>Acciones</th>                                    
                    </tr>     
                    <?php foreach ($aClientes as $cliente):?>
                        <tr>                           
                            <td><?php echo $cliente->cuit;?></td>
                            <td><?php echo $cliente->nombre;?></td>
                            <td><?php echo date_format(date_create($cliente->fecha_nac),"d-m-Y");?></td>
                            <td><?php echo $cliente->telefono;?></td>
                            <td><?php echo $cliente->correo;?></td>
                            <td></td>
                            <td>
                                <a href="cliente-formulario.php?id=<?php echo $cliente->idcliente; ?>"><i class="fas fa-edit"style="color:blue"></i></a></td>                                                
                        </tr>  
                    <?php endforeach;?>                        
            </table>
    </div>
</div>   
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>
</body>
</html>