
<?php

class BaseDeDatos{
    private $parametros = "mysql:host=127.0.0.1;dbname=monitor;charset=utf8mb4";
    private $conexion = null;
    private static $instancia = null;
    
    private function __construct(){
        $this -> conexion = new PDO($this -> parametros, 'root', 'cisco123');
    }
    public static function getInstancia(){
        if(self::$instancia == null){
            self::$instancia = new BaseDeDatos();
        }
        return self::$instancia;
    }
    public function getConexion(){
        return $this -> conexion;
    }
}

?>