<?php
 include_once "config.php";
    class Usuario{
        private $idusuario;
        private $usuario;
        private $clave;
        private $nombre;        
        private $apellido;
        private $telefono;
        private $correo;
        
        public function __construct(){

        }
        public function __get($atributo){
            return $this->$atributo;
        }
        public function __set($atributo, $valor){
            return $this->$atributo = $valor;
            return this;
        }    

        public function encriptarClave($clave){
            $claveEncriptada = password_hash($clave,PASSWORD_DEFAULT);
            return $claveEncriptada;
        }

        public function verificarClave($claveIngresada, $claveEnBBDD){
            return password_verify($claveIngresada,$claveEnBBDD);
        }
        public function insertar(){
            
            $mysqli = new mysqli(config::BBDD_HOST, config::BBDD_USUARIO, config::BBDD_CLAVE, config::BBDD_NOMBRE);
            //Arma la query
            $sql = "INSERT INTO usuarios (
            usuario,
            clave,
            nombre,
            apellido,
            correo             
            ) VALUES (                           
            '" . $this->usuario ."',
            '" . $this->clave ."',
            '" . $this->nombre ."',
            '" . $this->apellido ."',
            '" . $this->correo ."'                           
            );";
            //print_r($sql);exit;
            //Ejecuta la query
            if (!$mysqli->query($sql)){
                printf("Error en query: %s\n", $mysqli->error . " " .$sql);
            }
            //Obtiene el id generado por la inserción
            $this->idusuario = $mysqli ->insert_id;
            //cierra la conexion
            $mysqli->close();
        }

        public function obtenerPorUsuario(){            
            $mysqli = new mysqli(config::BBDD_HOST, config::BBDD_USUARIO, config::BBDD_CLAVE, config::BBDD_NOMBRE);            
            $sql = "SELECT idusuario,
                            usuario,
                            clave,
                            nombre,
                            apellido,
                            correo
                    FROM usuarios
                    WHERE usuario = '$this->usuario'";
            $resultado = $mysqli->query($sql);
            if (!$resultado =$mysqli->query($sql)){
                printf("Error en query: %s\n", $mysqli->error . " " .$sql);
            }  
           
            if ($fila = $resultado->fetch_assoc()){
                $this->idusuario = $fila["idusuario"];
                $this->usuario = $fila["usuario"];
                $this->clave = $fila["clave"];
                $this->nombre = $fila["nombre"];
                $this->apellido = $fila["apellido"];                
                $this->correo = $fila["correo"];              
            }
            $mysqli->close();  
        }
    }    


?>