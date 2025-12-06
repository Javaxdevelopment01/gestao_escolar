
<?php
require_once "../../config/connection.php";
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Content: application/json");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

$metodo= $_SERVER["REQUEST_METHOD"];
$dados_recebidos=json_decode(file_get_contents("php://input"),true);
$metodo_l=strtolower($metodo);

function Listar(){
    try {
        $sql="select *from periodo;";
        $stmt=$GLOBALS["connection"]->prepare($sql);
        $stmt->execute();
        $salas=$stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($salas);
    } catch (\Throwable $th) {
        //throw $th;
    }
}

function Cadastrar(){

}

function Alterar(){

}


switch ($metodo_l) {
    case 'get':
        Listar();
        break;
    case "put":
        Alterar();
        die();
        break;
    case "post":
        Cadastrar();
        break;
    case "delete":

        break;
    
    default:
        # code...
        break;
}