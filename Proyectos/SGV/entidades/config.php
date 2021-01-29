<?php 
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

//Iniciamos la session
session_start();

class Config {
    const BBDD_HOST = "192.168.0.210";
    const BBDD_USUARIO = "arnoldamorin";
    const BBDD_CLAVE = " 4EVJ.8678";
    const BBDD_NOMBRE = "arnoldamorin";
}

$mysqli = new mysqli(config::BBDD_HOST, config::BBDD_USUARIO, config::BBDD_CLAVE, config::BBDD_NOMBRE);  
$sql = "SELECT count(V.fk_idcliente) AS totalcliente                      
        FROM clientes C inner join Ventas V on V.fk_idcliente = C.idcliente
        WHERE C.idcliente = $id";
        
if (!$mysqli->query($sql)){
    printf("Error en query: %s\n", $mysqli->error . " " .$sql);             
} 
?>