<?php

include_once "entidades/config.php";
include_once "entidades/producto.php";
include_once "entidades/tipoproducto.php";
$pg = "Edición de producto";
$tipoproducto = new Tipoproducto();
$aTipoProducto = $tipoproducto->obtenerTodos();

$producto = new Producto();
$producto->cargarFormulario($_REQUEST);
$nombreImagen = "";

if ($_POST) {  
    if ($_FILES["archivo"]["error"] === UPLOAD_ERR_OK) {
        $nombreAleatorio = date("Ymdhmsi");
        $archivo_tmp = $_FILES["archivo"]["tmp_name"];
        $nombreArchivo = $_FILES["archivo"]["name"];
        $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
        $nombreImagen = $nombreAleatorio . "." . $extension;
        move_uploaded_file($archivo_tmp, "archivos/$nombreImagen");
    }
    if (isset($_POST["btnGuardar"])) {
        if (isset($_GET["id"]) && $_GET["id"] > 0) {
            $producto->obtenerPorId();            
            if ($nombreImagen != "" && $producto->imagen != "") {
                //si se sube una imagen y hay una imagen previa entonces eliminarla.
                unlink("archivos/" . $producto->imagen);
            }
            if ($nombreImagen == "") {
                //si la persona no sube ninguna imagen, conservar la imagen que tenia previamente
                $nombreImagen = $producto->imagen;               
                
            }            
            $producto->imagen = $nombreImagen;
            $producto->actualizar();
            $mensajeSuccess = "Producto actualizado correctamente";
        } else {
            //Es nuevo
            $producto->imagen = $nombreImagen;
            $producto->insertar();
            $mensajeSuccess = "Producto guardado correctamente";
        }
    } else if (isset($_POST["btnBorrar"])) {
        $total = $producto->obtenerProductosVendidos($producto->idproducto);
        if ($total > 0) {
            $mensajeError = "No se pueden eliminar productos con ventas asociadadas";
        } else {
            $producto->eliminar();
            $mensajeSuccess = "Producto eliminado correctamente";
           
        }
    }
}
if (isset($_GET["id"]) && $_GET["id"] > 0) {
    $producto->id = $_GET["id"];
    $producto->obtenerPorId();
  
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
    <title>Edición de producto</title>
</head>

<body>
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include 'menu.php'; ?>
        <form method="post" enctype="multipart/form-data" action="">
            <div class="container-fluid">
                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">Productos</h1>
                <div class="row">
                    <div class="col-12 mb-3">
                        <a href="productos-listado.php" class="btn btn-primary mr-2">Listado</a>
                        <a href="producto-formulario.php" class="btn btn-primary mr-2">Nuevo</a>
                        <button type="submit" class="btn btn-success mr-2" id="btnGuardar" name="btnGuardar">Guardar</button>
                        <button type="submit" class="btn btn-danger" id="btnBorrar" name="btnBorrar">Borrar</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 form-group">
                        <label for="txtNombre">Nombre:</label>
                        <input type="text" required="" class="form-control" name="txtNombre" id="txtNombre" value="<?php echo isset($_GET["id"]) ? $producto->nombre : "" ?>">
                    </div>
                    <div class="col-6 form-group">
                        <label for="txtTipoProducto">Tipo de producto:</label>
                        <select class="form-control selectpicker" id="lstTipoProducto" name="lstTipoProducto" data-live-search="true" value="">
                            <option class="dropdown-item" disabled selected>Seleccionar</option>
                            <?php foreach ($aTipoProducto as $elemento) :  ?>
                                <?php if (isset($_GET["id"]) && $_GET["id"] > 0  && $elemento->idtipoproducto == $producto->fk_idtipoproducto) { ?>
                                    <option value="<?php echo $elemento->idtipoproducto ?>" selected>
                                        <?php echo $elemento->nombre; ?></option>
                                <?php } else { ?>
                                    <option value="<?php echo $elemento->idtipoproducto ?>"><?php echo $elemento->nombre; ?>
                                    </option>
                                <?php } ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-6 form-group">
                        <label for="txtCantidad">Cantidad:</label>
                        <input type="number" class="form-control" name="txtCantidad" id="txtCantidad" value="<?php echo isset($_GET["id"]) ? $producto->cantidad : "" ?>">
                    </div>
                    <div class="col-6 form-group">
                        <label for="txtPrecio">Precio:</label>
                        <input type="number" class="form-control" name="txtPrecio" id="txtPrecio" value="<?php echo isset($_GET["id"]) ? $producto->precio : "" ?>">
                    </div>
                    <div class="form-group">
                        <h5>Imagen</h5>
                        <label for="archivo"></label>
                        <input type="file" name="archivo" id="archivo" class="form-control shadow p-1" value="">
                    </div>
                </div>
        </form>
        <?php if (isset($mensajeSuccess)) { ?>
            <div class="alert alert-success col-6" role="alert"><?= $mensajeSuccess ?></div>

        <?php }  ?>
        <?php if (isset($mensajeError)) { ?>
            <div class="alert alert-danger col-6" role="alert"><?= $mensajeError ?></div>

        <?php }  ?>      
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