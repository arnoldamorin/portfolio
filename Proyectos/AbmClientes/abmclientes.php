<?php 

if (file_exists("archivo.txt")){
    //leer el archivo, el contenido es un json
    $strJson = file_get_contents("archivo.txt");
    //guardar en el array de clientes ese json decodificado
    $aPersona = json_decode($strJson, true);
} else {
    $aPersona = array();
}

$id = isset($_GET["id"]) ? $_GET["id"] : "";
if(isset($_GET["id"]) && $_GET["id"]>= 0 && isset($_GET["do"]) && $_GET["do"] == "eliminar"){
    //eliminar la posicion deseada en el array, invertigar unset
    // pasar el array a json
    //actualizar el archivo con este nuevo json
    if(file_exists("archivos/". $aPersona[$id]["imagen"])){
        unlink("archivos/" . $aPersona[$id]["imagen"]);
    }
    unset($aPersona[$id]);
    $strJson = json_encode($aPersona, $strJson);
    header("Location: abmclientes.php");
}
if($_POST){
    $dni = $_POST["txtDni"];
    $nombre = $_POST["txtNombre"];
    $telefono = $_POST["txtTelefono"];
    $correo = $_POST["txtCorreo"];
    $nombreImagen ="";

    if ($_FILES["archivo"]["error"] === UPLOAD_ERR_OK){
        $nombreAleatorio = date("Ymdhmsi");
        $archivo_tmp = $_FILES["archivo"]["tmp_name"];
        $nombreArchivo = $_FILES["archivo"]["name"];
        $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
        $nombreImagen = $nombreAleatorio . "." . $extension;
        move_uploaded_file($archivo_tmp, "archivos/$nombreImagen");
    }
    //Actualizacion
    if( $id != "" && $id >=0 ){  
        
        if($nombreImagen != "" && $aPersona[$id]["imagen"] != "") {      
        
            //si se sube una imagen y hay una imagen previa entonces eliminarla.
            unlink("archivos/".$aPersona[$id]["imagen"]);
        }      
        if($nombreImagen == ""){
            //si la persona no sube ninguna imagen, conservar la imagen que tenia previamente
            $nombreImagen = $aPersona[$id]["imagen"];
        }
        $aPersona[$id]=array(
            "dni"=>$dni,   
            "nombre"=>$nombre,
            "telefono"=>$telefono,
            "correo"=>$correo,
            "imagen"=>$nombreImagen,
        );
          
    }else{
        //Es Nuevo
    $aPersona[]=array(
        "dni"=>$dni,   
        "nombre"=>$nombre,
        "telefono"=>$telefono,
        "correo"=>$correo,
        "imagen"=>$nombreImagen,
    );
    
    }

}

//convertir array en json
$strJson = json_encode($aPersona);
//guardar el json en un archivo archivo.txt
file_put_contents("archivo.txt", $strJson);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Abm Clientes</title>
    <link rel="stylesheet" href="css/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome/css/fontawesome.min.css">       
 
</head>    
    <main class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1>Registro clientes</h1>
            </div>
        </div>
        <div class="row"> 
            <div class="col-6">
                <form method="post" enctype="multipart/form-data" action=""  >
                <div class="mb-sm-3">
                    <h5>DNI:</h5>
                    <input type="text" id="txtDni" name="txtDni" class="form-control shadow" value="<?php echo isset($_GET["id"]) ? $aPersona[$_GET["id"]]["dni"] : "" ?>">
                </div>
                <div class="mb-sm-3">
                    <h5>Nombre:</h5>
                    <input type="text" id="txtNombre" name="txtNombre" class="form-control shadow" value="<?php echo isset($_GET["id"]) ? $aPersona[$_GET["id"]]["nombre"] : "" ?>">
                </div>
                <div class="mb-sm-3">
                    <h5>Teléfono</h5>
                    <input type="Telefono" id="txtTelefono" name="txtTelefono" class="form-control shadow"value="<?php echo isset($_GET["id"]) ? $aPersona[$_GET["id"]]["telefono"] : "" ?>">
                </div>
                <div class="mb-sm-3">
                    <h5>Correo</h5>
                    <input type="email" id="txtCorreo" name="txtCorreo" class="form-control shadow" value="<?php echo isset($_GET["id"]) ? $aPersona[$_GET["id"]]["correo"] : "" ?>">
                </div>    
                <div class="form-group">
                    <h5>Archivo Adjunto</h5> 
                    <label for="ejemplo_archivo_1"></label>
                    <input type="file" name="archivo" id="archivo" class="form-control shadow p-1" value="<?php echo isset($_GET["id"]) ? $aPersona[$_GET["id"]]["imagen"] : "" ?>">                
                </div>
                <div class="text-sm-left">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>            
            </form>          
            </div>
            <div class="col-6">
                <table class="table table-hover">
                <tr>
                    <th>Imagenes</th>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Correo</th>   
                    <th>Acciones</th>           
                </tr>
                    <?php if($aPersona != null){
                         foreach ($aPersona as $i => $valor){?>
                        <tr>
                            <th><img class="img-thumbnail" src="archivos/<?php echo $aPersona[$i]["imagen"];?>"></th>
                            <td><?php echo $aPersona[$i]["dni"];?></td>
                            <td><?php echo $aPersona[$i]["nombre"];?></td>
                            <td><?php echo $aPersona[$i]["correo"];?></td>
                            <th><a href="abmclientes.php?id=<?php echo $i ?>"><i class="fas fa-edit img-thumbnail"></i>
                            <a href="abmclientes.php?id=<?php echo $i ?>&do=eliminar"><i class="fas fa-trash-alt img-thumbnail img-fluid"></i></th>                                
                </tr>
                <?php }}?>        
                </table>
                <div>
                    <i class="fas fa-plus-circle"></i>
                </div>
            </div>
        </div>
    </main>
<body>
    
</body>
</html>