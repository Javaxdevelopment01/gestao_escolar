<?php
require_once "../../config/connection.php";
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$metodo= $_SERVER["REQUEST_METHOD"];
$dados_recebidos=json_decode(file_get_contents("php://input"),true);
$metodo_l=strtolower($metodo);
function Cadastrar()  {
    $id_aluno=htmlspecialchars($_POST["id_aluno"]);
    $id_disciplina=htmlspecialchars($_POST["id_disciplina"]);
    $id_professor=htmlspecialchars($_POST["id_professor"]);
    $id_turma=htmlspecialchars($_POST["id_turma"]);
    $tipo_avaliacao=htmlspecialchars($_POST["tipo_avaliacao"]);
    $valor_nota=htmlspecialchars($_POST["valor_nota"]);
    try {
        $sql="insert into nota(id_aluno, id_disciplina, id_professor, id_turma, tipo_avaliacao, valor_nota) values(:id_aluno, :id_disciplina, :id_professor, :id_turma, :tipo_avaliacao, :valor_nota)";

        $stmt=$GLOBALS["connection"]->prepare($sql);
        $stmt->bindValue(":id_aluno",$id_aluno);
        $stmt->bindValue(":id_disciplina",$id_disciplina);
        $stmt->bindValue(":id_professor",$id_professor);
        $stmt->bindValue(":id_turma",$id_turma);
        $stmt->bindValue(":tipo_avaliacao",$tipo_avaliacao);
        $stmt->bindValue(":valor_nota",$valor_nota);
        $stmt->execute();
        echo json_encode('{"Mensagem":"Nota Atribuida Com sucesso!"}');
    } catch (\Throwable $th) {
    
}
    
}
function Alterar() {
    try{
        $id_nota=htmlspecialchars($_GET["id_nota"]);
        $id_aluno=htmlspecialchars($_POST["id_aluno"]);
        $id_disciplina=htmlspecialchars($_POST["id_disciplina"]);
        $id_professor=htmlspecialchars($_POST["id_professor"]);
        $id_turma=htmlspecialchars($_POST["id_turma"]);
        $tipo_avaliacao=htmlspecialchars($_POST["tipo_avaliacao"]);
        $valor_nota=htmlspecialchars($_POST["valor_nota"]);
        global $connection;
        $sql="update nota set id_aluno=:id_aluno, id_disciplina=:id_disciplina, id_turma=:id_turma, tipo_avaliacao=:tipo_avaliacao, valor_nota=:valor_nota";
        $stmt=$connection->prepare($sql);
        $stmt->bindValue(":id_nota",$id_nota);
        $stmt->bindValue(":id_aluno",$id_aluno);
        $stmt->bindValue(":id_disciplina",$id_disciplina);
        $stmt->bindValue(":id_professor",$id_professor);
        $stmt->bindValue(":id_turma",$id_turma);
        $stmt->bindValue(":tipo_avaliacao",$tipo_avaliacao);
        $stmt->bindValue(":valor_nota",$valor_nota);
        $stmt->execute();
        echo json_encode(["Mensagem"=>"Atualizada Com Sucesso"]);



    }catch (\Throwable $e) {
        # code...
    }
    
}
function Listar(){
    try {
        $sql="select *from nota;";
        global $connection;
        $stmt=$connection->prepare($sql);
        $stmt->execute();
        $dados=$stmt->fetchAll(PDO::FETCH_ASSOC);
        ECHO json_encode($dados);

    } catch (\Throwable $e) {
        # code...
    }
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