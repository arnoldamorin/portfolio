<?php

include_once "entidades/config.php";
include_once "entidades/cliente.php";
/*include_once "entidades/provincia.entidad.php";
include_once "entidades/localidad.entidad.php";
include_once "entidades/domicilio.entidad.php";*/

$pg = "Edición de cliente";

$cliente = new Cliente();
$cliente->cargarFormulario($_REQUEST);

$eliminacion = false;
if ($_POST) {

    if (isset($_POST["btnGuardar"])) {
        if (isset($_GET["id"]) && $_GET["id"] > 0) {
            //actualizo un cliente existente
            $cliente->actualizar();
            $mensajeSuccess = "Cliente actualizado correctamente";
        } else {
            //Es nuevo
            $cliente->insertar();
            $mensajeSuccess = "Cliente guardado correctamente";
        }
        /*if(isset($_POST["txtTipo"])){
            $domicilio = new Domicilio();
            $domicilio->eliminarPorCliente($cliente->idcliente);
            for ($i=0; $i < count($_POST["txtTipo"]);$i++){
                $domicilio->fk_idcliente = $cliente->idcliente;
                $domicilio->fk_tipo = $_POST["txtTipo"][$i];
                $domicilio->fk_idlocalidad = $_POST["txtLocalidad"][$i];
                $domicilio->domicilio = $_POST["txtDomicilio"][$i];
                $domicilio->insertar();
            }
        }*/
    } else if (isset($_POST["btnBorrar"])) {
        $total = $cliente->obtenerClientesVentas($cliente->idcliente);
        if ($total > 0) {
            $mensajeError = "No se pueden eliminar clientes con ventas asociadadas";
        } else {
            $cliente->eliminar();
            $mensajeSuccess = "Cliente eliminado correctamente";
        }
        //$domicilio = new Domicilio();
        //$domicilio->eliminarPorCliente($cliente->idcliente);       
    }
}
if (isset($_GET["id"]) && $_GET["id"] > 0) {
    $cliente->id = $_GET["id"];
    $cliente->obtenerPorId();
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
    <title>Formulario cliente</title>
</head>

<body>

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include 'menu.php'; ?>
        <form method="post" enctype="multipart/form-data" action="">
            <div class="container-fluid">
                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">Cliente</h1>
                <div class="row">
                    <div class="col-12 mb-3">
                        <a href="clientes-listado.php" class="btn btn-primary mr-2">Listado</a>
                        <a href="cliente-formulario.php" class="btn btn-primary mr-2">Nuevo</a>
                        <button type="submit" class="btn btn-success mr-2" id="btnGuardar" name="btnGuardar">Guardar</button>
                        <button type="submit" class="btn btn-danger" id="btnBorrar" name="btnBorrar">Borrar</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 form-group">
                        <label for="txtNombre">Nombre:</label>
                        <input type="text" required="" class="form-control" name="txtNombre" id="txtNombre" value="<?php echo isset($_GET["id"]) ? $cliente->nombre : "" ?>">
                    </div>
                    <div class="col-6 form-group">
                        <label for="txtCuit">CUIT:</label>
                        <input type="text" required="" class="form-control" name="txtCuit" id="txtCuit" value="<?php echo isset($_GET["id"]) ? $cliente->cuit : "" ?>" maxlength="11">
                    </div>
                    <div class="col-6 form-group">
                        <label for="txtFechaNac">Fecha de nacimiento:</label>
                        <input type="date" class="form-control" name="txtFechaNac" id="txtFechaNac" value="<?php echo isset($_GET["id"]) ? date_format(date_create($cliente->fecha_nac), "Y-m-d") : "" ?>">
                    </div>
                    <div class="col-6 form-group">
                        <label for="txtTelefono">Teléfono:</label>
                        <input type="number" class="form-control" name="txtTelefono" id="txtTelefono" value="<?php echo isset($_GET["id"]) ? $cliente->telefono : "" ?>">
                    </div>
                    <div class="col-6 form-group">
                        <label for="txtCorreo">Correo:</label>
                        <input type="" class="form-control" name="txtCorreo" id="txtCorreo" required="" value="<?php echo isset($_GET["id"]) ? $cliente->correo : "" ?>">
                    </div>
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