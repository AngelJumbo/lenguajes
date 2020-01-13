<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/publicacion.php';
 
// instantiate database and publicacion object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$publicacion = new Publicacion($db);
 
$stmt = $publicacion->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // publicaciones array
    $publicaciones_arr=array();
    $publicaciones_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
        /*
         id_publicacion, dia, mes, año, descripcion, lugar, hora, duración

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
        */
        $publicacion_item=array(
            "publicacion_id" => $publicacion_id,
            "usuario_id" => $usuario_id,
            "Direccion" => $Direccion,
            "Mascota_id" => $Mascota_id,
            "CoordenadaY" => $CoordenadaY,
            "TipoPublicacion" => $TipoPublicacion,
            "CoordenadaX" => $CoordenadaX,
            "Comentarios" => $Comentarios,
            "EstadoCaso_id" => $EstadoCaso_id,
            "Fecha" => $Fecha
        );
 
        array_push($publicaciones_arr["records"], $publicacion_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show publicaciones data in json format
    echo json_encode($publicaciones_arr);
}else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no publicaciones found
    echo json_encode(
        array("message" => "No publicaciones found.")
    );
}