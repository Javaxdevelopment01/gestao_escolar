<?php
session_start();

session_regenerate_id();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../assets/_css/auth/login.css">
    <link rel="stylesheet" href="../../../assets/_css/auth/login-tablet.css">
    <link rel="stylesheet" href="../../../assets/_css/auth/login-pc.css">
    <script src="../../../assets/_js/auth/login.js" defer></script>
    <title>IPM-Login</title>
 
</head>

<body onload="mostrar()">

    <main>
        <section class="login">
            <div class="logo">
                <img src="../../../assets/_images/auth/logoescola.png" alt="" > 
            </div>
            <div class="formulario">
                <form>
                    <div>
                        <h1>Login</h1>
                    </div>
                    <div class="container">
                        <div class="campo">
                            <label for="username">Nome</label>
                            <input type="text" name="username" id="username" placeholder="Nome" class="input-field">
                        </div>
                        <div class="campo">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" id="email" placeholder="E-mail" class="input-field">
                        </div>
                        <div class="campo">
                            <label for="senha">Palavra-Passe</label>
                            <input type="password" name="senha" id="senha" placeholder="Palavra-Passe" class="input-field">
                        </div>
                        <div class="campo">
                        <button type="submit" id="btn-login" >Entrar</button>
                        </div>
                    </div>

                </form>
            </div>
        </section>
        <section class="info">
            <div class="card">
            <h3>Entre! Para poder gerenciar seu dados pessoais</h3>
<p>
    <strong>"Intituto Politecnico do Maiombe" <br>"Nº 4023-IPM"</strong> <hr>
    <span>Portal de Login para os Estudante do IPM</span>

</p>
            </div>
        </section>
    </main>
</body>

</html>