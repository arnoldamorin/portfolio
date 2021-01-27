<?php
    class Producto{
        private $idproducto;
        private $nombre;
        private $fk_idtipoproducto;
        private $cantidad;
        private $precio;
        private $descripcion;
        private $imagen;
    
        public function __construct(){
            $this->cantidad = 0;
            $this->cantidad = 0.0;

        }
        public function __get($atributo){
            return $this->$atributo;
        }
        public function __set($atributo, $valor){
            return $this->$atributo = $valor;
            return this;
        }
        public function cargarFormulario($request){
            $this->idproducto = isset($request["id"])? $request["id"] : "";
            $this->nombre = isset($request["txtNombre"])? $request["txtNombre"] : "";
            $this->fk_idtipoproducto = isset($request["lstTipoProducto"])? $request["lstTipoProducto"] : "";
            $this->cantidad = isset($request["txtCantidad"])? $request["txtCantidad"] : "";
            $this->precio = isset($request["txtPrecio"])? $request["txtPrecio"] : "";
            $this->imagen = isset($request["archivo"])? $request["archivo"] : "";
           /*$this->descripcion = isset($request["txtDescripcion"])? $request["txtDescripcion"] : "";            */
        }
        //Instancia la clase myqli con el constructor parametrizado 
            /*despues de precio pa vesto gg
                        
                '" . $this->imagen ."'           descripcion,
                imagen  */   
        public function insertar(){
            
            $mysqli = new mysqli(config::BBDD_HOST, config::BBDD_USUARIO, config::BBDD_CLAVE, config::BBDD_NOMBRE);
            //Arma la query
            $sql = "INSERT INTO productos (
                nombre,
                cantidad,
                precio,
                fk_idtipoproducto,
                imagen             
                ) VALUES (               
                '" . $this->nombre ."',
                '" . $this->cantidad ."',
                '" . $this->precio ."',               
                '" . $this->fk_idtipoproducto ."',
                '" . $this->imagen ."' 
                );";
                //print_r($sql);exit;
            //Ejecuta la query
            if (!$mysqli->query($sql)){
                printf("Error en query: %s\n", $mysqli->error . " " .$sql);
            }
            //Obtiene el id generado por la inserción
            $this->idproducto = $mysqli ->insert_id;
            //cierra la conexion
            $mysqli->close();
        }
        public function actualizar(){
            $mysqli = new mysqli(config::BBDD_HOST, config::BBDD_USUARIO, config::BBDD_CLAVE, config::BBDD_NOMBRE);
            //Arma la query
            $sql = "UPDATE productos SET
                nombre = '".$this->nombre."',
                cantidad = '" . $this->cantidad ."',
                precio = '" . $this->precio ."', 
                fk_idtipoproducto = '" . $this->fk_idtipoproducto ."',
                imagen = '" . $this->imagen ."'             
                WHERE idproducto = ".$this->idproducto;
            
            if (!$mysqli->query($sql)){
                printf("Error en query: %s\n", $mysqli->error . " " .$sql);
            }                     
            $mysqli->close();
        }
        public function eliminar(){
            $mysqli = new mysqli(config::BBDD_HOST, config::BBDD_USUARIO, config::BBDD_CLAVE, config::BBDD_NOMBRE);
            $sql = "DELETE FROM productos WHERE idproducto = ". $this->idproducto;
            //Ejecuta la query
            if (!$mysqli->query($sql)){
                printf("Error en query: %s\n", $mysqli->error . " " .$sql);
            }
            $mysqli->close();
        }
        public function obtenerPorId(){
            $mysqli = new mysqli(config::BBDD_HOST, config::BBDD_USUARIO, config::BBDD_CLAVE, config::BBDD_NOMBRE);            
            $sql = "SELECT  idproducto,                            
                            nombre,
                            fk_idtipoproducto,
                            cantidad,
                            precio,
                            descripcion,
                            imagen
                    FROM productos
                    WHERE idproducto = ".$this->idproducto;
             $resultado = $mysqli->query($sql);
            if (!$mysqli->query($sql)){
                printf("Error en query: %s\n", $mysqli->error . " " .$sql);
            }  
            if ($fila = $resultado->fetch_assoc()){
                $this->idcliente = $fila["idproducto"];
                $this->nombre = $fila["nombre"];
                $this->fk_idtipoproducto = $fila["fk_idtipoproducto"];
                $this->cantidad = $fila["cantidad"];
                $this->precio = $fila["precio"];
                $this->descripcion = $fila["descripcion"];
                $this->imagen = $fila["imagen"];
            }
            $mysqli->close();  
        }
        public function obtenerTodos(){
            $mysqli = new mysqli(config::BBDD_HOST, config::BBDD_USUARIO, config::BBDD_CLAVE, config::BBDD_NOMBRE);  
            $sql = "SELECT
            idproducto,
            nombre,
            fk_idtipoproducto,
            cantidad,
            precio,
            descripcion, 
            imagen
            FROM productos";          
           
            $resultado = $mysqli->query($sql);
            if($resultado){
                //convierte el resultado en un array asociativo
                while($fila = $resultado->fetch_assoc()){
                    $entidadAux = new Producto();
                    $entidadAux->idproducto = $fila["idproducto"];
                    $entidadAux->nombre = $fila["nombre"];
                    $entidadAux->fk_idtipoproducto = $fila["fk_idtipoproducto"];
                    $entidadAux->cantidad = $fila["cantidad"];
                    $entidadAux->precio = $fila["precio"];
                    $entidadAux->descripcion = $fila["descripcion"];
                    $entidadAux->imagen = $fila["imagen"];
                    $aResultado[] = $entidadAux;
                }
                return $aResultado;
            }         
        }                  
    }
?>