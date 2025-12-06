<?php
require_once "../../config/conexao.php";
$conn = Conexao::getConexao();

$mensagem = "";

// Criar Sala
if (isset($_POST['cadastrar'])) {
    try {
        $sql = "INSERT INTO sala (numero_sala, localizacao, capacidade_de_alunos) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $ok = $stmt->execute([$_POST['numero_sala'], $_POST['localizacao'], $_POST['capacidade']]);

        if ($ok) {
            $mensagem = "<p style='color:green;'>✅ Sala cadastrada com sucesso!</p>";
        } else {
            $mensagem = "<p style='color:red;'>❌ Erro: sala não foi cadastrada.</p>";
        }
    } catch (PDOException $e) {
        $mensagem = "<p style='color:red;'>⚠ Erro no cadastro: " . $e->getMessage() . "</p>";
    }
}

// Atualizar Sala
if (isset($_POST['atualizar'])) {
    try {
        $sql = "UPDATE sala SET numero_sala = ?, localizacao = ?, capacidade_de_alunos = ? WHERE id_sala = ?";
        $stmt = $conn->prepare($sql);
        $ok = $stmt->execute([$_POST['numero_sala'], $_POST['localizacao'], $_POST['capacidade'], $_POST['id_sala']]);

        if ($ok) {
            $mensagem = "<p style='color:green;'>✅ Sala atualizada com sucesso!</p>";
        } else {
            $mensagem = "<p style='color:red;'>❌ Erro: sala não foi atualizada.</p>";
        }
    } catch (PDOException $e) {
        $mensagem = "<p style='color:red;'>⚠ Erro na atualização: " . $e->getMessage() . "</p>";
    }
}

// Excluir Sala
if (isset($_GET['excluir'])) {
    try {
        $sql = "DELETE FROM sala WHERE id_sala = ?";
        $stmt = $conn->prepare($sql);
        $ok = $stmt->execute([$_GET['excluir']]);

        if ($ok) {
            $mensagem = "<p style='color:green;'>✅ Sala excluída com sucesso!</p>";
        } else {
            $mensagem = "<p style='color:red;'>❌ Erro: sala não foi excluída.</p>";
        }
    } catch (PDOException $e) {
        $mensagem = "<p style='color:red;'>⚠ Erro na exclusão: " . $e->getMessage() . "</p>";
    }
}

// Buscar salas cadastradas
$sql = "SELECT * FROM sala";
$stmt = $conn->query($sql);
$salas = $stmt->fetchAll();
?>