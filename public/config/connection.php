<?php
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