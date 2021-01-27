<?php
    class Tipoproducto{
        private $idtipoproducto;
        private $nombre;
        
        public function __construct(){         

        }
        public function __get($atributo){
            return $this->$atributo;
        }
        public function __set($atributo, $valor){
            return $this->$atributo = $valor;
            return this;            
        }
        public function cargarFormulario($request){
            $this->idtipoproducto = isset($request["id"])? $request["id"] : "";
            $this->nombre = isset($request["txtNombre"])? $request["txtNombre"] : "";                
        }
        
        public function insertar(){
            //Instancia la clase myqli con el constructor parametrizado
            $mysqli = new mysqli(config::BBDD_HOST, config::BBDD_USUARIO, config::BBDD_CLAVE, config::BBDD_NOMBRE);
            //Arma la query
            $sql = "INSERT INTO tipo_productos(
                nombre
                ) VALUES (               
                '" . $this->nombre ."'
                );";
                //print_r($sql);exit;
            //Ejecuta la query
            if (!$mysqli->query($sql)){
                printf("Error en query: %s\n", $mysqli->error . " " .$sql);
            }
            //Obtiene el id generado por la inserción
            $this->idtipoproducto = $mysqli ->insert_id;
            //cierra la conexion
            $mysqli->close();
        }
        public function actualizar(){
            $mysqli = new mysqli(config::BBDD_HOST, config::BBDD_USUARIO, config::BBDD_CLAVE, config::BBDD_NOMBRE);
            //Arma la query
            $sql = "UPDATE tipo_productos SET
                nombre = '".$this->nombre."'                           
                WHERE idtipoproducto = ".$this->idtipoproducto;
            
            if (!$mysqli->query($sql)){
                printf("Error en query: %s\n", $mysqli->error . " " .$sql);
            }                     
            $mysqli->close();
        }
        public function eliminar(){
            $mysqli = new mysqli(config::BBDD_HOST, config::BBDD_USUARIO, config::BBDD_CLAVE, config::BBDD_NOMBRE);
            $sql = "DELETE FROM tipo_productos WHERE idtipoproducto = ". $this->idtipoproducto;
            //Ejecuta la query
            if (!$mysqli->query($sql)){
                printf("Error en query: %s\n", $mysqli->error . " " .$sql);
            }
            $mysqli->close();
        }
        public function obtenerPorId(){
            $mysqli = new mysqli(config::BBDD_HOST, config::BBDD_USUARIO, config::BBDD_CLAVE, config::BBDD_NOMBRE);            
            $sql = "SELECT  idtipoproducto,                            
                            nombre                            
                    FROM tipo_productos
                    WHERE idtipoproducto = ".$this->idtipoproducto;
            $resultado = $mysqli->query($sql);
            if (!$mysqli->query($sql)){
                printf("Error en query: %s\n", $mysqli->error . " " .$sql);
            }  
            if ($fila = $resultado->fetch_assoc()){
                $this->idtipoproducto = $fila["idtipoproducto"];
                $this->nombre = $fila["nombre"];            
            }
            $mysqli->close();  
        }
        public function obtenerTodos(){
            $mysqli = new mysqli(config::BBDD_HOST, config::BBDD_USUARIO, config::BBDD_CLAVE, config::BBDD_NOMBRE);  
            $sql = "SELECT
            idtipoproducto,
            nombre           
            FROM tipo_productos";
            if (!$resultado = $mysqli->query($sql)){
                printf("Error en query: %s\n", $mysqli->error . " ". $sql);
            }
            $resultado = $mysqli->query($sql);
            if($resultado){
                //convierte el resultado en un array asociativo
                while($fila = $resultado->fetch_assoc()){
                    $entidadAux = new Tipoproducto();
                    $entidadAux->idtipoproducto = $fila["idtipoproducto"];
                    $entidadAux->nombre = $fila["nombre"];            
                    $aResultado[] = $entidadAux;
                }
            }
            return $aResultado;
            
        }
        
    }
?>