<?php

include_once "entidades/config.php";
include_once "entidades/tipoproducto.php";


$tipoproducto = new Tipoproducto();
$tipoproducto->cargarFormulario($_REQUEST);

if($_POST){

    if(isset($_POST["btnGuardar"])){
        if(isset($_GET["id"]) && $_GET["id"] > 0){
            //actualizo un tipoproducto existente
            $tipoproducto->actualizar();
        } else {
            //Es nuevo
            $tipoproducto->insertar();
        }        
    } else if(isset($_POST["btnBorrar"])){    
        $tipoproducto->eliminar();
    }
        
}

if(isset($_GET["id"]) && $_GET["id"] > 0 ){
    $tipoproducto->id = $_GET["id"];
    $tipoproducto->obtenerPorId();
   
   
}
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
    <title>Tipo de producto</title>
</head>
<body>
<!-- Page Wrapper -->
<div id="wrapper">
    <?php include 'menu.php';?>
    <form method="post" enctype="multipart/form-data" action="">
        <div class="container-fluid">
            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Tipo de productos</h1>
            <div class="row">
                <div class="col-12 mb-3">
                    <a href="tipoproductos.php" class="btn btn-primary mr-2">Listado</a>
                    <a href="tipoproducto-formulario.php" class="btn btn-primary mr-2">Nuevo</a>
                    <button type="submit" class="btn btn-success mr-2" id="btnGuardar" name="btnGuardar">Guardar</button>
                    <button type="submit" class="btn btn-danger" id="btnBorrar" name="btnBorrar">Borrar</button>
                </div>
            </div>
            <div class="row">
                <div class="col-12 form-group">
                    <label for="txtNombre">Nombre:</label>
                    <input type="text" required="" class="form-control" name="txtNombre" id="txtNombre" value="<?php echo $tipoproducto->nombre?>">
                </div>     
            </div>
        </div>        
    </form>
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