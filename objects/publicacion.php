<?php
class Publicacion{
 
    // database connection and table name
    private $conn;
    private $table_name = "publicaciones";
 
    // object properties
    public $publicacion_id;
    public $usuario_id;
    public $Direccion;
    public $CoordenadaX;
    public $CoordenadaY;
    public $TipoPublicacion;
    public $Mascota_id;
    public $Comentarios;
    public $EstadoCaso_id;
    public $Fecha;

 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read alumnos
    function read(){
        //'SELECT * FROM alumno WHERE cedula = "075639896"'
        // select all query
        $query = "SELECT
                   publicacion_id, usuario_id, Direccion, CoordenadaX, CoordenadaY, TipoPublicacion,Mascota_id,Comentarios,EstadoCaso_id,Fecha
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

    /* $query = "SELECT a.nombres, a.apellidos, a.direccion, a.fecha_nacimiento, a.observacion, a.cedula, a.cursos_curso_id 
            FROM ". $this->table_name ." a, autorizacion aut 
            WHERE aut.autorizado_cedula = ? and aut.alumno_cedula = a.cedula 
            ORDER BY nombres DESC"; */

    function read_adopciones(){
        // select all query
        $query = "SELECT
                   publicacion_id, usuario_id, Direccion, CoordenadaX, CoordenadaY, TipoPublicacion,Mascota_id,Comentarios,EstadoCaso_id,Fecha
              FROM
                    " . $this->table_name . " p, tipopublicaciones tp
                WHERE p.TipoPublicacion = tp.TipoPublicacion_id and p.TipoPublicacion = \"adopcion\" 
                ORDER BY
                    nombres DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    function read_perdidos(){
        // select all query
        $query = "SELECT
                   publicacion_id, usuario_id, Direccion, CoordenadaX, CoordenadaY, TipoPublicacion,Mascota_id,Comentarios,EstadoCaso_id,Fecha
              FROM
                    " . $this->table_name . " p, tipopublicaciones tp
                WHERE p.TipoPublicacion = tp.TipoPublicacion_id and p.TipoPublicacion = \"perdidos\" 
                ORDER BY
                    nombres DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

   

}