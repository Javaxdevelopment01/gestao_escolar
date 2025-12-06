<?php
require_once "../../../assets/_includes/header.php";
?>
<title>Usuario Do Sistema</title>
<link rel="stylesheet" href="../../../assets/_css/usuario/main.css">
<?php
require_once "../../../assets/_includes/menu.php";
?>
<main>
    <h1>Usuarios</h1>
    <div class="container">
        <div class="card-search">
            <div class="search-bar">
                <span class="mdi mdi-magnify"></span>
                <input type="text" id="search-user" name="search-user">
            </div>
        </div>
        <div class="controlls">
            <button class="mdi mdi-shape-square-rounded-plus" onclick="MostrarModel()">Adicionar</button>
        </div>
        <div class="lista-Usuario">
            <table>
                <thead>
                    <tr>Código</tr>
                    <tr>Numero do B.I</tr>
                    <tr>Nome</tr>
                    <tr>Email</tr>
                    <tr>Cargo</tr>
                    <tr>Ultimo Login</tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="container-add-user" id="container-add-user">
        <div class="card-fomulario">
            <div class="campo">
                <input type="text" name="bi_funcionario" id="bi_funcionario" placeholder="Digite o B.I do Funcionario">
                <button class="mdi mdi-mafnigy">Procurar</button>
            </div>
            <div class="campo">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" readonly>
            </div>
            <div class="campo">
                <label for="email">E-mail</label>
                <input type="text" name="email" id="email" readonly>
            </div>
            <div class="campo">
                <label for="cargo">Cargo</label>
                <input type="text" name="cargo" id="cargo" readonly>
            </div>
           
            <div class="campo">
                <label for="senha">Senha</label>
                <input type="text" name="senha" id="senha" >
            </div>
            <div class="campo">
                <label for="confirmar-senha">Confirmar Senha</label>
                <input type="text" name="confirmar-senha" id="confirmar-senha">
            </div>
            <div class="campo">
                <input type="submit" value="Confirmar">
            </div>
        </div>
    </div>
</main>
<script src="../../../assets/_js/usuario/script.js"></script>
<?php
require_once "../../../assets/_includes/footer.php";
?> 
