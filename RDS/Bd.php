<?php
class Bd{
    private $conexion=null;

    public function __construct()
    {
        //Establecer la conexión con la BD
        try {
            //code...
            $this->conexion = new PDO()
        } catch (\Throwable $th) {
           global $error;
           $error=$th->getMessage();
        }
    }

    /**
     * Get the value of conexion
     */ 
    public function getConexion()
    {
        return $this->conexion;
    }

    /**
     * Set the value of conexion
     *
     * @return  self
     */ 
    public function setConexion($conexion)
    {
        $this->conexion = $conexion;

        return $this;
    }
}
?>