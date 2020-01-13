<?php
class Mascota{
 
    // database connection and table name
    private $conn;
    private $table_name = "mascotas";
 
    // object properties
    public $Mascota_id;
    public $Nombre;
    public $Color_id;
    public $TipoMascota_id;
    public $Raza_id;
    public $size;
    public $Edad;
    public $Descripcion;

 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read alumnos
    function read(){
        //'SELECT * FROM alumno WHERE cedula = "075639896"'
        // select all query
        $query = "SELECT
                   Mascota_id, Nombre, Color_id, TipoMascota_id, Raza_id, size,Edad,Descripcion 
              FROM
                    " . $this->table_name . "
                ORDER BY
                    nombres DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

   

}