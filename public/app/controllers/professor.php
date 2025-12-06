<?php
require_once "../../config/connection.php";
header("Content-Type:application/json");
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Content:application/json");
header("Access-Control-Allow-Method:POST,GET,PUT,DELETE");
$metodo_Puro=$_SERVER["REQUEST_METHOD"];
$dados_recebidos=json_decode(file_get_contents("php://input"),true);
$metodo=strtolower($metodo_Puro);
function Listar()  {
    $sql="select id_funcionario,nome_funcionario,sobrenome_funcionario,bilhete_funcionario,email_funcionario,telefone,provincia_regidencia, municipio_regidencia,bairro_regidencia,departamento,img from funcionario join departamento on funcionario.id_departamento=departamento.id_departamento where cargo='Professor'";
    try {
        $stmt=$GLOBALS["connection"]->prepare($sql);
        $stmt->execute();
        $funcionarios=$stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($funcionarios);
    } catch (\Throwable $th) {
        echo json_encode(["Erro"=>$th->getMessage()]);
        //throw $th;
    }
}
switch ($metodo) {
    case 'get':
        # code...
        Listar();
        break;
    
    case 'post':
        # code...

        break;
    
    case 'put':
        # code...
        #Actualizar();
        break;
    
    case 'delete':
        #Deletar();
        # code...
        break;
    
    default:
        # code...
        break;
}