
<?php
require_once "../../config/connection.php";
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Content: application/json");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

$metodo= $_SERVER["REQUEST_METHOD"];
$dados_recebidos=json_decode(file_get_contents("php://input"),true);
$metodo_l=strtolower($metodo);
 
function Cadastrar(){
    $extensao=pathinfo($_FILES["fileInput"]["name"],PATHINFO_EXTENSION);
    $extensao=strtolower(($extensao));
    $extensoes=["pdf"];
    if (in_array($extensao,$extensoes)) {
               $pastaupload="../../assets/_uploads/livros/";
               $pdf_temporario_enviado=$_FILES["fileInput"]["tmp_name"];
               $novo_nome_pdf=uniqid().$_FILES["fileInput"]["name"];
               $livro=$pastaupload.$novo_nome_pdf;
               if (move_uploaded_file($pdf_temporario_enviado,$pastaupload.$novo_nome_pdf)) {
                    try {
                        $titulo=htmlspecialchars($_POST["titulo"]);
                        $editora=htmlspecialchars($_POST["editora"]);
                        $autor=htmlspecialchars($_POST["autor"]);
                         $sql="insert into livro(titulo,editora,autor, caminho_arquivo) values(:titulo,:editora,:autor, :path);";
                         $stmt=$GLOBALS["connection"]->prepare($sql);
                         $stmt->bindValue(":titulo",$editora);
                         $stmt->bindValue(":editora",$editora);
                         $stmt->bindValue(":autor",$autor);
                         $stmt->bindValue(":path",$livro);
                         $stmt->execute();
                         echo json_encode(["Mensagem"=>"Salvo Com Sucesso!"]);
                         
                    } catch (\Throwable $th) {
                        //throw $th;
                    }
               }else{
                    echo json_encode(["Mensagem"=>"Livro Não Cadastrado <br> Não Foi possiver Realizar o Upload da Imagem!"]);
                    die();
        }
    } else {
        echo json_encode(["Mensagem"=>"Livro Não Cadastrado <br> Só Aceitamos Arquivos do tipo PDF"]);
        die();
    }

}
function Listar(){
    try {
        $sql="select autor,caminho_arquivo,titulo, editora from livro;";
        $stmt=$GLOBALS["connection"]->prepare($sql);
        $stmt->execute();
        $livros=$stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($livros);

    } catch (\Throwable $th) {
     echo json_encode(["msm"=>$th]);
    }
    
}
switch ($metodo_l) {
    case 'post':
        Cadastrar();
        die();
        # code...
        break;
    case 'get';
    Listar();
    die();
    
    default:
        # code...
        break;
}