<?php
require_once "../../config/conexao.php";
$conn = Conexao::getConexao();

$mensagem = "";

// Criar Curso
if (isset($_POST['cadastrar'])) {
    try {
        $sql = "INSERT INTO curso (curso, id_area_formacao, duracao) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $ok = $stmt->execute([$_POST['curso'], $_POST['area_formacao'], $_POST['duracao']]);

        if ($ok) {
            $mensagem = "<p style='color:green;'>✅ Curso cadastrado com sucesso!</p>";
        } else {
            $mensagem = "<p style='color:red;'>❌ Erro: curso não foi cadastrado.</p>";
        }
    } catch (PDOException $e) {
        $mensagem = "<p style='color:red;'>⚠ Erro no cadastro: " . $e->getMessage() . "</p>";
    }
}

// Atualizar Curso
if (isset($_POST['atualizar'])) {
    try {
        $sql = "UPDATE curso SET curso = ?, id_area_formacao = ?, duracao = ? WHERE id_curso = ?";
        $stmt = $conn->prepare($sql);
        $ok = $stmt->execute([$_POST['curso'], $_POST['area_formacao'], $_POST['duracao'], $_POST['id_curso']]);

        if ($ok) {
            $mensagem = "<p style='color:green;'>✅ Curso atualizado com sucesso!</p>";
        } else {
            $mensagem = "<p style='color:red;'>❌ Erro: curso não foi atualizado.</p>";
        }
    } catch (PDOException $e) {
        $mensagem = "<p style='color:red;'>⚠ Erro na atualização: " . $e->getMessage() . "</p>";
    }
}

// Excluir Curso
if (isset($_GET['excluir'])) {
    try {
        $sql = "DELETE FROM curso WHERE id_curso = ?";
        $stmt = $conn->prepare($sql);
        $ok = $stmt->execute([$_GET['excluir']]);

        if ($ok) {
            $mensagem = "<p style='color:green;'>✅ Curso excluído com sucesso!</p>";
        } else {
            $mensagem = "<p style='color:red;'>❌ Erro: curso não foi excluído.</p>";
        }
    } catch (PDOException $e) {
        $mensagem = "<p style='color:red;'>⚠ Erro na exclusão: " . $e->getMessage() . "</p>";
    }
}

// Buscar cursos cadastrados (com JOIN para exibir área de formação)
$sql = "SELECT c.id_curso, c.curso, c.duracao, c.criado_em, a.nome_area 
        FROM curso c
        JOIN area_formacao a ON c.id_area_formacao = a.id_area_formacao";
$stmt = $conn->query($sql);
$cursos = $stmt->fetchAll();

// Buscar áreas de formação para o select
$sqlAreas = "SELECT * FROM area_formacao";
$stmtAreas = $conn->query($sqlAreas);
$areas = $stmtAreas->fetchAll();
?>