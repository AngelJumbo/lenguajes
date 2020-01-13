<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/mascota.php';
 
// instantiate database and mascota object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$mascota = new Mascota($db);
 
$stmt = $mascota->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // mascotaes array
    $mascotaes_arr=array();
    $mascotaes_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
        /*
         id_mascota, dia, mes, año, descripcion, lugar, hora, duración
            public $Mascota_id;
    public $Nombre;
    public $Color_id;
    public $TipoMascota_id;
    public $Raza_id;
    public $size;
    public $Edad;
    public $Descripcion;

        */
        $mascota_item=array(
            "Mascota_id" => $Mascota_id,
            "Nombre" => $Nombre,
            "Color_id" => $Color_id,
            "TipoMascota_id" => $TipoMascota_id,
            "Raza_id" => $Raza_id,
            "size" => $size,
            "Edad" => $Edad,
            "Descripcion" => $Descripcion
        );
 
        array_push($mascotaes_arr["records"], $mascota_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show mascotaes data in json format
    echo json_encode($mascotaes_arr);
}else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no mascotaes found
    echo json_encode(
        array("message" => "No mascotas found.")
    );
}