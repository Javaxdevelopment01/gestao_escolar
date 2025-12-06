<?php
require_once "../../config/connection.php";
header("Content-Type: application/json ");
header("Content-Type:application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
 
$metodo_l= $_SERVER["REQUEST_METHOD"];
$dados_recebidos=json_decode(file_get_contents("php://input"),true);
$metodo=strtolower($metodo_l);

function Cadastrar(){
    try {
        $turma=htmlspecialchars($_POST["turma"]);
        #$id_sala
    } catch (\Throwable $th) {
        //throw $th;
    }

}
function Listar(){
    try {
        $sql='select turma.id_turma, turma.turma, sala.numero_sala, curso.curso,turma.ano , concat(classe.classe,"º Classe") as classe, periodo.periodo
 from turma join sala on turma.id_sala=sala.id_sala join curso on curso.id_curso=turma.id_curso
 join classe on classe.id_classe=turma.id_classe join periodo on periodo.id_periodo=turma.id_turma;';
    $stmt=$GLOBALS["connection"]->prepare($sql);
    $stmt->execute();
    $turmas=$stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($turmas);

    } catch (\Throwable $th) {
       echo json_encode(["Mensagem"=>"Falha ao listar"]);
    }
}
switch ($metodo) {
    case 'get':
        Listar();
        # code...
        break;
    case "put":
        break;
    case "post":

        break;
    case "delete":

        break;
    
    default:
        # code...
        break;
}