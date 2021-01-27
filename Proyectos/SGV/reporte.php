<?php 
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=reporte.csv');

include_once "entidades/config.php";
include_once "entidades/venta.php";
$venta = new Venta();
$aVenta = $venta->obtenerTodos();
$fp = fopen('php://output','w');
$cabecera = array('Fecha', 'Nombre Cliente','Nombre Producto','Cantidad','Total');
fputcsv($fp,$cabecera,";");
foreach ($aVenta as $campos){
    fputcsv($fp, array($campos->fecha,$campos->nombre_cliente,$campos->nombre_producto,$campos->cantidad,$campos->total),";");
}
fclose($fp);
?>