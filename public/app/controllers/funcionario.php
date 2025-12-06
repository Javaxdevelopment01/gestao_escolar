<?php
require_once "../../config/connection.php";
header("Content-Type:application/json");
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Content:application/json");
header("Access-Control-Allow-Method:POST,GET,PUT,DELETE");
$metodo_Puro=$_SERVER["REQUEST_METHOD"];
$dados_recebidos=json_decode(file_get_contents("php://input"),true);
$metodo=strtolower($metodo_Puro);
function Cadastrar(){
    $nome_funcionario=htmlspecialchars($_POST["nome_funcionario"]);
    $sobrenome_funcionario=htmlspecialchars($_POST["sobrenome_funcionario"]);
    $bilhete_funcionario=htmlspecialchars($_POST["bilhete_funcionario"]);
    $email_funcionario=htmlspecialchars($_POST["email_funcionario"]);
    $telefone=htmlspecialchars($_POST["telefone"]);
    $cargo=htmlspecialchars($_POST["cargo"]);
    $provincia_residencia=htmlspecialchars($_POST["provincia_residencia"]);
    $municipio_residencia=htmlspecialchars($_POST["municipio_residencia"]);
    $bairro_residencia=htmlspecialchars($_POST["bairro_residencia"]);
    $status_funcionario=htmlspecialchars($_POST["status_funcionario"]);
    $descricao=htmlspecialchars($_POST["descricao"]);
    $id_departamento=htmlspecialchars($_POST["id_departamento"]);
    $extensao=pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);
    $extensao=strtolower($extensao);
    $extensoes=["jpg","png","jpeg","gif"];
    if (in_array($extensao, $extensoes)) {
         $pastaupload="../../assets/_uploads/fotosFuncionario/";
        $foto_temporario=$_FILES["img"]["tmp_name"];
        $novoNomeFoto="$nome_funcionario"."$bilhete_funcionario.$extensao";
        $img=$pastaupload.$novoNomeFoto;
        if (move_uploaded_file($foto_temporario, $pastaupload.$novoNomeFoto)) {
                
                        try {
              
                            $sql="
                            insert into funcionario
                            (nome_funcionario,sobrenome_funcionario,email_funcionario,bilhete_funcionario,telefone,provincia_regidencia,municipio_regidencia,bairro_regidencia,descricao,id_departamento,img,status_funcionario,cargo) values
                            (:nome_funcionario,:sobrenome_funcionario ,:email_funcionario,:bilhete_funcionario,:telefone,:provincia_regidencia,:municipio_regidencia,:bairro_regidencia,:descricao,:id_departamento,:img,:status_funcionario,:cargo);";
                            $stmt=$GLOBALS["connection"]->prepare($sql);

                            $stmt->bindValue(":nome_funcionario",$nome_funcionario);
                            $stmt->bindValue(":sobrenome_funcionario",$sobrenome_funcionario);
                            $stmt->bindValue(":bilhete_funcionario",$bilhete_funcionario);
                            $stmt->bindValue(":email_funcionario",$email_funcionario);
                            $stmt->bindValue(":telefone",$telefone);
                            $stmt->bindValue(":provincia_regidencia",$provincia_residencia);
                            $stmt->bindValue(":municipio_regidencia",$municipio_residencia);
                            $stmt->bindValue(":bairro_regidencia",$bairro_residencia);
                            $stmt->bindValue(":status_funcionario",$status_funcionario);
                            $stmt->bindValue(":descricao",$descricao);
                            $stmt->bindValue(":id_departamento",$id_departamento);
                            $stmt->bindValue(":img",$img);
                            $stmt->bindValue(":cargo",$cargo);
                            $stmt->execute();
                            
                            echo json_encode(["Mensagem"=>"Salvo Com Sucesso!"]);
                        } catch (\Throwable $th) {
                            //throw $th;
                            echo json_encode(["Mensagem v"=>$th->getMessage()]);
                        }
           
        }else{
             echo json_encode(["Mensagem"=>"Aluno não cadastrado <br> Não Foi possiver Realizar o Upload da Imagem!"]);
            die();
        }
    }
    else {
            echo json_encode(["Mensagem"=>"Aluno não Cadastrado <br> Só Aceitamos Arquivos do tipo Imagem"]);
            die();
    }
}
function Listar()  {
    $sql="select nome_funcionario,sobrenome_funcionario,bilhete_funcionario,email_funcionario,telefone,provincia_regidencia, municipio_regidencia,bairro_regidencia,departamento,img from funcionario join departamento on funcionario.id_departamento=departamento.id_departamento";
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
function Deletar(){
    try {
        $codigo_funcionario=$_GET["id_funcionario"];
        $sql="delete from funcionario where id_funcionario=:id_funcionario;";
        $stmt=$GLOBALS["connection"]->prepare($sql);
        $stmt->bindValue(":id_funcionario",$codigo_funcionario);
        $stmt->execute();
        echo json_encode(["Mensagem"=>"Eliminado com Suceso!"]);
    } catch (\Throwable $th) {
        //throw $th;
    }
}
function Actualizar(){
    $codigo_funcionario=$_GET["id_funcionario"];
     $nome_funcionario=htmlspecialchars($_POST["nome_funcionario"]);
    $sobrenome_funcionario=htmlspecialchars($_POST["sobrenome_funcionario"]);
    $bilhete_funcionario=htmlspecialchars($_POST["bilhete_funcionario"]);
    $email_funcionario=htmlspecialchars($_POST["email_funcionario"]);
    $telefone=htmlspecialchars($_POST["telefone"]);
    $provincia_residencia=htmlspecialchars($_POST["provincia_residencia"]);
    $municipio_residencia=htmlspecialchars($_POST["municipio_residencia"]);
    $bairro_residencia=htmlspecialchars($_POST["bairro_residencia"]);
    $status_funcionario=htmlspecialchars($_POST["status_funcionario"]);
    $descricao=htmlspecialchars($_POST["descricao"]);
    $id_departamento=htmlspecialchars($_POST["id_departamento"]);
    $extensao=pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);
    $extensao=strtolower($extensao);
    $extensoes=["jpg","png","jpeg","gif"];
    if (in_array($extensao, $extensoes)) {
        $pastaupload="../../assets/_uploads/fotosFuncionario/";
        $foto_temporario=$_FILES["img"]["tmp_name"];
        $novoNomeFoto="$nome_funcionario"."$bilhete_funcionario.$extensao";
        $img=$pastaupload.$novoNomeFoto;
        if (move_uploaded_file($foto_temporario, $pastaupload.$novoNomeFoto)) {
                
                        try {
              
                            $sql="update  funcionario set
                            (nome_funcionario=:nome_funcionario, sobrenome_funcionario=:sobrenome_funcionario, email_funcionario=:email_funcionario, bilhete_funcionario=:bilhete_funcionario, telefone=:telefone, provincia_regidencia=:provincia_regidencia, municipio_regidencia=:municipio_regidencia, bairro_regidencia=:bairro_regidencia ,  descricao=:descricao, id_departamento=:id_departamento , img=:img where id_funcionario=:id_funcionario;";
                            $stmt=$GLOBALS["connection"]->prepare($sql);

                            $stmt->bindValue(":nome_funcionario",$nome_funcionario);
                            $stmt->bindValue(":sobrenome_funcionario",$sobrenome_funcionario);
                            $stmt->bindValue(":bilhete_funcionario",$bilhete_funcionario);
                            $stmt->bindValue(":email_funcionario",$email_funcionario);
                            $stmt->bindValue(":telefone",$telefone);
                            $stmt->bindValue(":provincia_residencia",$provincia_residencia);
                            $stmt->bindValue(":municipio_residencia",$municipio_residencia);
                            $stmt->bindValue(":bairro_residencia",$bairro_residencia);
                            $stmt->bindValue(":status_funcionario",$status_funcionario);
                            $stmt->bindValue(":descricao",$descricao);
                            $stmt->bindValue(":id_departamento",$id_departamento);
                            
                            $stmt->bindValue(":img",$img);
                            $stmt->bindValue(":id_funcionario",$codigo_funcionario);
                            $stmt->execute();
                            
                            echo json_encode(["Mensagem"=>"Actualizado Com Sucesso!"]);
                        } catch (\Throwable $th) {
                            //throw $th;
                            echo json_encode(["Mensagem"=>$th->getMessage()]);
                        }
           
        }else{
             echo json_encode(["Mensagem"=>"Aluno não cadastrado <br> Não Foi possiver Realizar o Upload da Imagem!"]);
            die();
        }
    }
    else {
            echo json_encode(["Mensagem"=>"Aluno não Cadastrado <br> Só Aceitamos Arquivos do tipo Imagem"]);
            die();
    }
}
switch ($metodo) {
    case 'get':
        # code...
        Listar();
        break;
    
    case 'post':
        # code...
Cadastrar();
        break;
    
    case 'put':
        # code...
        Actualizar();
        break;
    
    case 'delete':
        Deletar();
        # code...
        break;
    
    default:
        # code...
        break;
}