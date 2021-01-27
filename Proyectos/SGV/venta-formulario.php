<?php

include_once "entidades/config.php";
include_once "entidades/producto.php";
include_once "entidades/cliente.php";
include_once "entidades/venta.php";

$cliente = new Cliente();
$aCliente = $cliente->obtenerTodos();
$producto= new Producto();
$aProducto =$producto->obtenerTodos();
$venta = new Venta();
$venta->cargarFormulario($_REQUEST);
if($_POST){
   /* if ($_FILES["archivo"]["error"] === UPLOAD_ERR_OK){
        $nombreAleatorio = date("Ymdhmsi");
        $archivo_tmp = $_FILES["archivo"]["tmp_name"];
        $nombreArchivo = $_FILES["archivo"]["name"];
        $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
        $nombreImagen = $nombreAleatorio . "." . $extension;
        move_uploaded_file($archivo_tmp, "archivos/$nombreImagen");
    }*/
    if(isset($_POST["btnGuardar"])){
        if(isset($_GET["id"]) && $_GET["id"] > 0){
            //actualizo un producto existente
            $venta->actualizar();
        } else {
            //Es nuevo
            $venta->insertar();
        }        
    } else if(isset($_POST["btnBorrar"])){     
        $venta->eliminar();
    }
       
}
if(isset($_GET["id"]) && $_GET["id"] > 0 ){
    $venta->id = $_GET["id"];
    $venta->obtenerPorId();   
}
if(isset($_GET["do"]) && $_GET["do"]>0){
    $venta->obtenerPorId();

}
if(isset($_GET["do"]) && $_GET["do"] == "buscarProducto"){
    $producto = new Producto();
    $producto->idproducto = $_GET["id"]; 
    $producto->obtenerPorId();    
    echo json_encode($producto->precio);
    exit;
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
    <title>Formulario de Ventas</title>
</head>

<body>
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include 'menu.php';?>
        <form method="post" enctype="multipart/form-data" action="">
      
            <div class="container-fluid">
                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">Venta</h1>
                <div class="row">
                    <div class="col-12 mb-3">
                        <a href="ventas.php" class="btn btn-primary mr-2">Listado</a>
                        <a href="venta-formulario.php" class="btn btn-primary mr-2">Nuevo</a>
                        <button type="submit" class="btn btn-success mr-2" id="btnGuardar"
                            name="btnGuardar">Guardar</button>
                        <button type="submit" class="btn btn-danger" id="btnBorrar" name="btnBorrar">Borrar</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 form-group">
                        <label for="txtFecha">Fecha:</label>
                        <input type="date" class="form-control" name="txtFecha" id="txtFecha"
                            value="<?php echo date_format(date_create($venta->fecha),"Y-m-d");?>">
                    </div>
                    <div class="col-6 form-group">
                        <label for="txtHora">Hora</label>
                        <input type="time" required="" class="form-control" name="txtHora" id="txtHora"
                            value="<?php echo date_format(date_create($venta->fecha),"H:i");?>">
                    </div>
                    <div class="col-6 form-group">
                        <label for="txtFk_idcliente">Cliente:</label>
                        <select class="form-control" id="lstCliente" name="lstCliente" data-live-search="true">
                            <option class="dropdown-item disabled">Seleccionar</option>
                            <?php foreach ($aCliente as $elemento):  ?>
                            <?php if($elemento->idcliente == $venta->fk_idcliente){?>
                            <option value="<?php echo $elemento->idcliente?>" selected>
                                <?php echo $elemento->nombre;?></option>
                            <?php }else {?>
                            <option value="<?php echo $elemento->idcliente?>"><?php echo $elemento->nombre;?></option>
                            <?php }?>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="col-6 form-group">
                        <label for="lstProducto">Producto:</label>
                        <select onchange ="fBuscarPrecioUnitario();" class="form-control selectpicker" id="lstProducto" name="lstProducto"
                            data-live-search="true">
                            <option class="dropdown-item disabled">Seleccionar</option>
                            <?php foreach ($aProducto as $elemento):  ?>
                            <?php if($elemento->idproducto == $venta->fk_idproducto){?>
                            <option value="<?php echo $elemento->idproducto?>" selected>
                                <?php echo $elemento->nombre;?></option>
                            <?php }else {?>
                            <option value="<?php echo $elemento->idproducto?>"><?php echo $elemento->nombre;?></option>
                            <?php }?>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="col-6 form-group">
                        <label for="txtPrecioUnitario">Precio unitario:</label>
                        <input type="" class="form-control" name="txtPrecioUnitario" id="txtPrecioUnitario" required type ="number"
                            value="<?php echo $venta->preciounitario?>">
                    </div>
                    <div class="col-6 form-group">
                        <label for="txtCantidad">Cantidad:</label>
                        <input type="" class="form-control" name="txtCantidad" id="txtCantidad" required=""
                            value="<?php echo $venta->cantidad?>">
                    </div>
                    <div class="col-6 form-group">
                        <label for="txtCorreo">Total:</label>
                        <input type="" class="form-control" name="txtTotal" id="txtTotal" required=""
                            value="<?php echo $venta->total?>">
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
<script>
        function fBuscarPrecioUnitario(){
            idProducto = $("#lstProducto").val();
            $.ajax({
	            type: "GET",
	            url: "venta-formulario.php?do=buscarProducto",
	            data: { id:idProducto },
	            async: true,
	            dataType: "json",
	            success: function (respuesta) {
                    $("#txtPrecioUnitario").val(respuesta);
                  
	            }
	        });
        }
        </script>