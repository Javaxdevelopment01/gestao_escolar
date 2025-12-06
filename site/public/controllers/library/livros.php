<?php
header("Access-Controls-Allow-Origin:*");
header("Access-Controls-Allow-Method:post,get,put,delete");
header("Access-Controls-Allow-Content:application/json");
header("Content-Type:application/json");
$metodo_s=$_SERVER["REQUEST_METHOD"];
$metodo=strtolower($metodo_s);
$dados_recebidos=json_decode(file_get_contents("php://input"),true);
function Cadastrar(){
    // up load dos pdf
    $extensao=pathinfo($_FILES["livro_upload"]["name"],PATHINFO_EXTENSION);
    $extensoes="pdf";
    if ($extensao!==$extensoes) {
        echo json_encode('{"Mensagem":"Só Aceitamos Arquivos PDF"}');
        die();
        # code...
    }
    try {
        $connection=new PDO("mysql:host=localhost;dbname=gestao_escolar","root","");
        $titulo=htmlspecialchars($_POST["titulo"]);
        $editora=htmlspecialchars($_POST["editora"]);
        $autor=htmlspecialchars($_POST["autor"]);
        $editora=htmlspecialchars($_POST["editora"]);
        $id_funcionario=htmlspecialchars($_POST["id_funcionario"]);
        $caminho_arquivo=htmlspecialchars($_POST["caminho_arquivo"]);
        $id_categoria=htmlspecialchars($_POST["id_categoria"]);
        $pastaUpload="../../uploads/livros/"; 
        $caminho_livro=$_FILES["livro_upload"]["tmp_name"];
        $novo_nome="";
        $img="$pastaUpload"."$novo_nome";
        if (move_uploaded_file($caminho_livro,$pastaUpload.$novo_nome)) {
            $sql="INSERT INTO livro (titulo,editora,autor,id_funcionario,caminho_arquivo,id_categoria) VALUES (:titulo,:editora,:autor,:id_funcionario,:caminho_arquivo,:id_categoria)";
            $stmt=$connection->prepare($sql);
            $stmt->bindParam(":titulo",$titulo);   
            $stmt->bindParam(":editora",$editora);
            $stmt->bindParam(":autor",$autor);
            $stmt->bindParam(":id_funcionario",$id_funcionario);
            $stmt->bindParam(":caminho_arquivo",$img);
            $stmt->bindParam(":id_categoria",$id_categoria);
            $stmt->execute();
            echo json_encode('{"Mensagem":"Livro Cadastrado com Sucesso"}');
            die();
            }else{
                  echo json_encode('{"Mensagem":"Não foi possivel fazer o upload"}');
            die();
            }

        } catch (\Throwable $e) {
            # code...
             echo json_encode('{"Mensagem":"Erro Ao cadastrar 1"}');
            die();




        }
        echo json_encode('{"Mensagem":"Erro ao Cadastrar Livro"}');
        

        }
    
switch ($metodo) {
    case 'get':
        
        die();
        break;
    case "post":
        die();
        break;
    case "put":
        die();
        break;
    case "delete":
        die();
        break;
    
    default:

        # code...
        break;
}
