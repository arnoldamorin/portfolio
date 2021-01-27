<?php 
include_once "entidades/config.php";
include_once "entidades/usuario.php";

$usuario = new Usuario();
$usuario->usuario = "arnoldsango";
$usuario->clave = $usuario->encriptarClave("1234");
$usuario->nombre = "Arnold";
$usuario->apellido = "Amorin";
$usuario->correo = "aamorin.ar@gmail.com";
$usuario->insertar();
?>