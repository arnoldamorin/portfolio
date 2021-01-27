<?php
include_once "entidades/cliente.php";
include_once "entidades/producto.php";
class Venta
{
    private $idventa;
    private $fk_idcliente;
    private $fk_idproducto;
    private $fecha;
    private $hora;
    private $cantidad;
    private $preciounitario;
    private $total;


    public function __construct()
    {
    }
    public function __get($atributo)
    {
        return $this->$atributo;
    }
    public function __set($atributo, $valor)
    {
        return $this->$atributo = $valor;
    }
    public function cargarFormulario($request)
    {
        $this->idventa = isset($request["id"]) ? $request["id"] : "";
        $this->fk_idcliente = isset($request["lstCliente"]) ? $request["lstCliente"] : "";
        $this->fk_idproducto = isset($request["lstProducto"]) ? $request["lstProducto"] : "";
        $this->fecha = isset($request["txtFecha"]) ? $request["txtFecha"] : "";
        $this->hora = isset($request["txtHora"]) ? $request["txtHora"] : "";
        $this->cantidad = isset($request["txtCantidad"]) ? $request["txtCantidad"] : "";
        $this->preciounitario = isset($request["txtPrecioUnitario"]) ? $request["txtPrecioUnitario"] : "";
        $this->total = isset($request["txtTotal"]) ? $request["txtTotal"] : "";
    }
    public function insertar()
    {
        //Instancia la clase myqli con el constructor parametrizado
        $mysqli = new mysqli(config::BBDD_HOST, config::BBDD_USUARIO, config::BBDD_CLAVE, config::BBDD_NOMBRE);
        //Arma la query
        $sql = "INSERT INTO ventas (
                fk_idcliente,
                fk_idproducto,
                fecha,
                cantidad,
                preciounitario,
                total                
                ) VALUES (             
                '" . $this->fk_idcliente . "',
                '" . $this->fk_idproducto . "',
                '" . $this->fecha . " " . $this->hora . "',
                '" . $this->cantidad . "',
                '" . $this->preciounitario . "',
                '" . $this->total . "'                             
                );";
        //print_r($sql);exit;
        //Ejecuta la query
        if (!$mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }
        //Obtiene el id generado por la inserción
        $this->idproducto = $mysqli->insert_id;
        //cierra la conexion
        $mysqli->close();
    }
    public function actualizar()
    {
        $mysqli = new mysqli(config::BBDD_HOST, config::BBDD_USUARIO, config::BBDD_CLAVE, config::BBDD_NOMBRE);
        //Arma la query
        $sql = "UPDATE ventas SET
                fk_idcliente = '" . $this->fk_idcliente . "',
                fk_idproducto = '" . $this->fk_idproducto . "',
                fecha = '" . $this->fecha . "',
                hora = '" . $this->hora . "',
                cantidad = '" . $this->cantidad . "',
                preciounitario= '" . $this->preciounitario . "',
                total = '" . $this->total . "'             
                WHERE idventa = " . $this->idventa;

        if (!$mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }
        $mysqli->close();
    }
    public function eliminar()
    {
        $mysqli = new mysqli(config::BBDD_HOST, config::BBDD_USUARIO, config::BBDD_CLAVE, config::BBDD_NOMBRE);
        $sql = "DELETE FROM ventas WHERE idventa = " . $this->idventa;
        //Ejecuta la query
        if (!$mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }
        $mysqli->close();
    }
    public function obtenerPorId()
    {
        $mysqli = new mysqli(config::BBDD_HOST, config::BBDD_USUARIO, config::BBDD_CLAVE, config::BBDD_NOMBRE);
        $sql = "SELECT  V.idventa,
                            V.fk_idcliente,
                            V.fk_idproducto,
                            V.fecha,                     
                            V.cantidad,
                            V.preciounitario,
                            V.total                            
                    FROM ventas V
                    WHERE idventa = " . $this->idventa;

        if (!$mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }

        $resultado = $mysqli->query($sql);
        if ($fila = $resultado->fetch_assoc()) {
            $this->idventa = $fila["idventa"];
            $this->fk_idcliente = $fila["fk_idcliente"];
            $this->fk_idproducto = $fila["fk_idproducto"];
            $this->fecha = $fila["fecha"];
            $this->cantidad = $fila["cantidad"];
            $this->preciounitario = $fila["preciounitario"];
            $this->total = $fila["total"];
        }
        $mysqli->close();
    }
    public function obtenerTodos()
    {
        $mysqli = new mysqli(config::BBDD_HOST, config::BBDD_USUARIO, config::BBDD_CLAVE, config::BBDD_NOMBRE);
        $sql = "SELECT  V.idventa,
                            V.fk_idcliente,
                            C.nombre as nombre_cliente,
                            V.fk_idproducto,
                            P.nombre as nombre_producto,
                            V.fecha,                        
                            V.cantidad,
                            V.preciounitario,
                            V.total                         
                    FROM ventas V 
                    inner join clientes C ON V.fk_idcliente = C.idcliente 
                    inner join productos P ON P.idproducto = V.fk_idproducto
                    ORDER BY V.fecha";

        $resultado = $mysqli->query($sql);

        if ($resultado) {
            //convierte el resultado en un array asociativo
            while ($fila = $resultado->fetch_assoc()) {
                $entidadAux = new Venta();
                $entidadAux->idventa = $fila["idventa"];
                $entidadAux->fk_idcliente = $fila["fk_idcliente"];
                $entidadAux->nombre_cliente = $fila["nombre_cliente"];
                $entidadAux->fk_idproducto = $fila["fk_idproducto"];
                $entidadAux->nombre_producto = $fila["nombre_producto"];
                $entidadAux->fecha = $fila["fecha"];
                $entidadAux->cantidad = $fila["cantidad"];
                $entidadAux->preciounitario = $fila["preciounitario"];
                $entidadAux->total = $fila["total"];
                $aResultado[] = $entidadAux;
            }
            return $aResultado;
        }
        $mysqli->close();
    }
    public function actualizarStock()
    {
        $mysqli = new mysqli(config::BBDD_HOST, config::BBDD_USUARIO, config::BBDD_CLAVE, config::BBDD_NOMBRE);
        //Arma la query
        $sql = "UPDATE productos SET                
                cantidad = cantidad -'" . $this->cantidad . "',                
                WHERE idproducto = " . $this->fk_idproducto;
        if (!$mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }
        $mysqli->close();
    }
    public function obtenerFacturacionMensual($mes)
    {
        $mysqli = new mysqli(config::BBDD_HOST, config::BBDD_USUARIO, config::BBDD_CLAVE, config::BBDD_NOMBRE);
        $sql = "SELECT sum(total) AS totalmes                        
                    FROM ventas  
                    WHERE MONTH(fecha) = $mes";
        if (!$mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }
        $resultado = $mysqli->query($sql);
        $fila = $resultado->fetch_assoc();
        return $fila["totalmes"];
    }
    public function obtenerFacturacionAnual($anio)
    {
        $mysqli = new mysqli(config::BBDD_HOST, config::BBDD_USUARIO, config::BBDD_CLAVE, config::BBDD_NOMBRE);
        $sql = "SELECT sum(total) AS totalanio                        
                    FROM ventas  
                    WHERE YEAR(fecha) = $anio";
        if (!$mysqli->query($sql)) {
            printf("Error en query: %s\n", $mysqli->error . " " . $sql);
        }
        $resultado = $mysqli->query($sql);
        $fila = $resultado->fetch_assoc();
        return $fila["totalanio"];
    }
   
}
