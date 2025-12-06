
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
    //
    // Cadastrar Aluno
    $nome_aluno=htmlentities($_POST['nome_aluno']);
    $sobrenome_aluno=htmlentities($_POST['sobrenome_aluno']);
    $bi_aluno=htmlentities($_POST['bi_aluno']);
    $email_aluno=htmlentities($_POST['email_aluno']);
    $numero_matricula_aluno=htmlentities($_POST['numero_matricula_aluno']);
    $telefone=htmlentities($_POST['telefone']);
    $provincia_regidencia=htmlentities($_POST['provincia_regidencia']);
    $municipio_regidencia=htmlentities($_POST['municipio_regidencia']);
    $bairro_regidencia=htmlentities($_POST['bairro_regidencia']);
    $status_aluno=htmlentities($_POST['status_aluno']);
    $id_turma=htmlentities($_POST['id_turma']);
    // UPLOAd IMG
   // $fotoAluno=$_FILES["foto_aluno"];
     $extensao=pathinfo($_FILES["foto_aluno"]["name"], PATHINFO_EXTENSION);
     $extensao=strtolower($extensao);
    $extensoes=["jpg","png","jpeg","gif"];
    if (in_array($extensao, $extensoes)) {
        $pastaupload="../../assets/_uploads/fotosAlunos/";
        $foto_temporario=$_FILES["foto_aluno"]["tmp_name"];
        $novoNomeFoto="$nome_aluno"."$bi_aluno.$extensao";
        $img=$pastaupload.$novoNomeFoto;
        if (move_uploaded_file($foto_temporario, $pastaupload.$novoNomeFoto)) {
                    
            try {
                $slq="insert into aluno(nome_aluno,sobrenome_aluno,bi_aluno,email_aluno,numero_matricula_aluno,telefone,provincia_regidencia,municipio_regidencia,bairro_regidencia,status_aluno,id_turma,img) values (:nome_aluno,:sobrenome_aluno,:bi_aluno,:email_aluno,:numero_matricula_aluno,:telefone,:provincia_regidencia,:municipio_regidencia,:bairro_regidencia,:status_aluno,:id_turma, :img)";

                $stmt=$GLOBALS['connection']->prepare($slq);
                $stmt->bindValue(":nome_aluno",$nome_aluno);
                $stmt->bindValue(":sobrenome_aluno",$sobrenome_aluno);
                $stmt->bindValue(":email_aluno",$email_aluno);
                $stmt->bindValue(":numero_matricula_aluno",$numero_matricula_aluno);
                $stmt->bindValue(":telefone",$telefone);
                $stmt->bindValue(":provincia_regidencia",$provincia_regidencia);
                $stmt->bindValue(":municipio_regidencia",$municipio_regidencia);
                $stmt->bindValue(":bairro_regidencia",$bairro_regidencia);
                $stmt->bindValue(":status_aluno",$status_aluno);
                $stmt->bindValue(":id_turma",$id_turma);
                $stmt->bindValue(":bi_aluno",$bi_aluno);
                $stmt->bindValue(":img",$img);
                $stmt->execute();
                echo json_encode(["Mensagem"=>"Salvo Com Sucesso!"]);
            } catch (\Throwable $th) {
                echo "Erro: ".$th->getMessage();
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
function Listar(){
    try {
        $sql='select aluno.id_aluno, concat(nome_aluno," ",sobrenome_aluno) as nome_aluno,
aluno.bi_aluno, aluno.email_aluno, aluno.numero_matricula_aluno, aluno.telefone,
aluno.bairro_regidencia, aluno.municipio_regidencia, aluno.status_aluno,
aluno.img,turma.turma, sala.numero_sala, curso.curso,turma.ano , concat(classe.classe,"º Classe") as classe, periodo.periodo
FROM gestao_escolar.aluno join turma on aluno.id_turma=turma.id_turma join sala on turma.id_sala=sala.id_sala join curso on curso.id_curso=turma.id_curso
 join classe on classe.id_classe=turma.id_classe join periodo on periodo.id_periodo=turma.id_turma;';
        $stmt=$GLOBALS['connection']->prepare($sql);
        $stmt->execute();
        $alunos=$stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($alunos);
       
    } catch (\Throwable $th) {
        echo "Erro: ".$th->getMessage();
    }
    
}
function Alterar()  {
    $id=$_GET['id_aluno'];
       $nome_aluno=htmlentities($_POST['nome_aluno']);
    $sobrenome_aluno=htmlentities($_POST['sobrenome_aluno']);
    $email_aluno=htmlentities($_POST['email_aluno']);
    $numero_matricula_aluno=htmlentities($_POST['numero_matricula_aluno']);
    $telefone=htmlentities($_POST['telefone']);
    $provincia_regidencia=htmlentities($_POST['provincia_regidencia']);
    $municipio_regidencia=htmlentities($_POST['municipio_regidencia']);
    $bairro_regidencia=htmlentities($_POST['bairro_regidencia']);
    $senha_hash=htmlentities($_POST['senha_hash']);
    $status_aluno=htmlentities($_POST['status_aluno']);
    $id_turma=htmlentities($_POST['id_turma']);
    try {
        $sql="update aluno set nome_aluno=:nome_aluno,sobrenome_aluno=:sobrenome_aluno,email_aluno=:email_aluno,numero_matricula_aluno=:numero_matricula_aluno,telefone=:telefone,provincia_regidencia=:provincia_regidencia,municipio_regidencia=:municipio_regidencia,bairro_regidencia=:bairro_regidencia,status_aluno=:status_aluno,id_turma=:id_turma where id_aluno=:id";
        $stmt=$GLOBALS['connection']->prepare($sql);
        $stmt->bindValue(":nome_aluno",$nome_aluno);
        $stmt->bindValue(":sobrenome_aluno",$sobrenome_aluno);
        $stmt->bindValue(":email_aluno",$email_aluno);
        $stmt->bindValue(":numero_matricula_aluno",$numero_matricula_aluno);
        $stmt->bindValue(":telefone",$telefone);
        $stmt->bindValue(":provincia_regidencia",$provincia_regidencia);
        $stmt->bindValue(":municipio_regidencia",$municipio_regidencia);
        $stmt->bindValue(":bairro_regidencia",$bairro_regidencia);
        $stmt->bindValue(":status_aluno",$status_aluno);
        $stmt->bindValue(":id_turma",$id_turma);
        $stmt->bindValue(":id",$id);
        $stmt->execute();
        echo json_encode(["Mensagem"=>"Alterado Com Sucesso!"]);
    } catch (\Throwable $th) {
        echo "Erro: ".$th->getMessage();
    }
    
}

switch ($metodo_l) {
    case 'get':
       Listar();
       die();
       break;
       case "put":
        Alterar();
        die();
        break;
        case "post":
            Cadastrar();
        die();

        break;
    case "delete":
        
        break;
    
    default:
        # code...
        break;
}