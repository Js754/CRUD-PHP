<?php 
    date_default_timezone_set("America/Sao_Paulo");

    $host = "localhost";
    $dbname = "modulo2";
    $username = "root";
    $dbpass = "";

    try
    {
        $PDO = new PDO("mysql:host=$host;dbname=$dbname", "$username", "$dbpass");
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }
    catch(PDOException $Error)
    {
        echo "Erro Ao Se Conectar Ao Banco De Dados: Erro:" . $Error->getMessage();
    }

?>