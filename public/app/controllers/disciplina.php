<?php
 
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$metodo= $_SERVER["REQUEST_METHOD"];
$dados_recebidos=json_decode(file_get_contents("php://input"));
$metodo_l=strtolower($metodo);
$user="root";
$senha="";
$bdname="gestao_escolar";
$server_host="localhost";
try {
    $connection=new PDO("mysql:host=$server_host;dbname=$bdname",$user,$senha);
}catch(PDOException $erro){
    echo "Erro:".$erro->getMessage();
}
 catch (\Throwable $erro) {
    echo "Erro:".$erro->getMessage();
}
function Cadastrar(){
 

    $nome_disciplina=htmlspecialchars($_POST["nome_disciplina"]);
    $carga_horaria=htmlspecialchars($_POST["carga_horaria"]);
    $id_funcionario=htmlspecialchars($_POST["id_funcionario"]);
    
    try{
        global $connection;
        $sql="insert into disciplina(nome_disciplina,carga_horaria,id_funcionario) values(:nome_disciplina,:carga_horaria,:id_funcionario)";
        $stmt=$connection->prepare($sql);
        $stmt->bindValue(":nome_disciplina",$nome_disciplina);
        $stmt->bindValue(":carga_horaria",$carga_horaria);
        $stmt->bindValue(":id_funcionario",$id_funcionario);
        $stmt->execute();
        echo json_encode(array("status"=>"success","message"=>"Disciplina cadastrada com sucesso!"));
    }
    catch(PDOException $erro){
        echo json_encode(array("statusgggg"=>"errorDPO","message"=>$erro->getMessage()));
    }
    catch (\Throwable $erro) {
        echo json_encode(array("status"=>"error","message"=>$erro->getMessage()));
    }

}


function Listar() {
    try{
        global $connection;
        $sql="select id_disciplina,nome_disciplina, carga_horaria, funcionario.nome_funcionario  from disciplina join funcionario on funcionario.id_funcionario= disciplina.id_funcionario where funcionario.cargo = 'Professor'";
        $stmt=$connection->prepare($sql);
        $stmt->execute();
        $resultados=$stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($resultados);
    }
    catch(PDOException $erro){
        echo json_encode(array("status"=>"error","message"=>$erro->getMessage()));
    }
    catch (\Throwable $erro) {
        echo json_encode(array("status"=>"error","message"=>$erro->getMessage()));
    }
    
}
function Deletar()  {
    $id_disciplina=htmlentities($_GET["id_disciplina"]);
    try{
        global $connection;
        $sql="delete from disciplina where id_disciplina=:id_disciplina";
        $stmt=$connection->prepare($sql);
        $stmt->bindParam(":id_disciplina",$id_disciplina);
        $stmt->execute();
        echo json_encode(array("status"=>"success","message"=>"Disciplina deletada com sucesso!"));
    }
    catch(PDOException $erro){
        echo json_encode(array("status"=>"error","message"=>$erro->getMessage()));
    }
    catch (\Throwable $erro) {
        echo json_encode(array("status"=>"error","message"=>$erro->getMessage()));
    }
    
}
switch ($metodo_l) {
    case 'get':
        Listar();
        die();
        break;
    case "post":
            Cadastrar();
        
        die();
        break;

    case 'put':
        Alterar();
        die();
        break;
    case "delete":
        Deletar();
        die();

        break;
    
    default:
        # code...
        break;
}