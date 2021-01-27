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
if($_POST){

    if(isset($_POST["btnGuardar"])){
        if(isset($_GET["id"]) && $_GET["id"] > 0){
            //actualizo un cliente existente
            $cliente->actualizar();
           
        } else {
            //Es nuevo
            $cliente->insertar();
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
    } else if(isset($_POST["btnBorrar"])){
        //$domicilio = new Domicilio();
        //$domicilio->eliminarPorCliente($cliente->idcliente);
        $cliente->eliminar();
        $eliminacion = true;
    }   
}
if(isset($_GET["id"]) && $_GET["id"] > 0 ){
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
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <title>Formulario cliente</title>
</head>

<body>

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include 'menu.php';?>
        <form method="post" enctype="multipart/form-data" action="">
            <div class="container-fluid">
                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">Cliente</h1>
                <div class="row">
                    <div class="col-12 mb-3">
                        <a href="clientes-listado.php" class="btn btn-primary mr-2">Listado</a>
                        <a href="cliente-formulario.php" class="btn btn-primary mr-2">Nuevo</a>
                        <button type="submit" class="btn btn-success mr-2" id="btnGuardar"
                            name="btnGuardar">Guardar</button>
                        <button type="submit" class="btn btn-danger" id="btnBorrar" name="btnBorrar">Borrar</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 form-group">
                        <label for="txtNombre">Nombre:</label>
                        <input type="text" required="" class="form-control" name="txtNombre" id="txtNombre"
                            value="<?php echo isset($_GET["id"]) ? $cliente->nombre :"" ?>">
                    </div>
                    <div class="col-6 form-group">
                        <label for="txtCuit">CUIT:</label>
                        <input type="text" required="" class="form-control" name="txtCuit" id="txtCuit"
                            value="<?php echo isset($_GET["id"]) ? $cliente->cuit:"" ?>" maxlength="11">
                    </div>
                    <div class="col-6 form-group">
                        <label for="txtFechaNac">Fecha de nacimiento:</label>
                        <input type="date" class="form-control" name="txtFechaNac" id="txtFechaNac"
                            value="<?php  echo isset($_GET["id"]) ? date_format(date_create($cliente->fecha_nac),"Y-m-d"):""?>">
                    </div>
                    <div class="col-6 form-group">
                        <label for="txtTelefono">Teléfono:</label>
                        <input type="number" class="form-control" name="txtTelefono" id="txtTelefono"
                            value="<?php echo isset($_GET["id"]) ? $cliente->telefono:"" ?>">
                    </div>
                    <div class="col-6 form-group">
                        <label for="txtCorreo">Correo:</label>
                        <input type="" class="form-control" name="txtCorreo" id="txtCorreo" required=""
                            value="<?php echo isset($_GET["id"]) ? $cliente->correo:"" ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fa fa-table"></i> Domicilios
                                <div class="pull-right">
                                    <button type="button" class="btn btn-secondary" data-toggle="modal"
                                        data-target="#modalDomicilio">Agregar</button>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div id="grilla_wrapper" class="dataTables_wrapper no-footer">
                                    <div id="grilla_processing" class="dataTables_processing" style="display: none;">
                                        Processing...</div>
                                    <table id="grilla" class="display dataTable no-footer" style="width: 98%;"
                                        role="grid" aria-describedby="grilla_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="grilla" rowspan="1"
                                                    colspan="1" aria-label="Tipo: activate to sort column descending"
                                                    aria-sort="ascending" style="width: 252px;">Tipo</th>
                                                <th class="sorting" tabindex="0" aria-controls="grilla" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Provincia: activate to sort column ascending"
                                                    style="width: 393px;">Provincia</th>
                                                <th class="sorting" tabindex="0" aria-controls="grilla" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Localidad: activate to sort column ascending"
                                                    style="width: 409px;">Localidad</th>
                                                <th class="sorting" tabindex="0" aria-controls="grilla" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Dirección: activate to sort column ascending"
                                                    style="width: 398px;">Dirección</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="odd">
                                                <td valign="top" colspan="4" class="dataTables_empty">No data available
                                                    in table</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="dataTables_info" id="grilla_info" role="status" aria-live="polite">
                                        Showing 0 to 0 of 0 entries</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-12">
                <?php if ($eliminacion) {?>
                <div class="alert alert-danger" role="alert">
                    <strong>Cliente eliminado con exito!</strong>
                </div>
                <?php $eliminacion=false; } ?>
            </div>

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