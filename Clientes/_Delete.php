<?php 

    require_once "../Core/Connection.php";

    if(isset($_GET["Confirmed"]) and ($_GET["Confirmed"]) == 1)
    {
        $sql = "DELETE FROM Clientes WHERE ID = :ID;";
        //
        $Delete = $PDO->prepare($sql);
        $Delete->bindValue(":ID", $_GET['Request_ID']);
        $Delete->execute();

        //Redirect To Index.php
        header("Location: Index.php");

        $Success = "Cliente ID " . $_GET['Request_ID'] . "Deletado Com Sucesso!";
        echo "<script>alert('$Success')</script>";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação</title>

    <style>
        * 
        {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body 
        {
            background-color: #c1c1c1;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        main 
        {
            width: 450px;
            border-radius: 20px;
            background-color: white;
            box-shadow: 3px 3px 3px 3px #333;
            padding: 20px 30px;
        }

        .container h1 
        {
            width: 100%;
            height: 100%; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 22px;
            text-align:center;
        }

        .container p 
        {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 18px;
            margin-bottom: 30px;
            margin-top: 15px;
        }

        a 
        {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 18px;
            font-weight: bold;
        }

        .Buttons
        {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
 
        .Buttons .btnNao
        {
            padding: 10px 20px;
            background-color: #333;
            color: white;
            border-radius: 10px;
            text-decoration: none;
        }

        .Buttons .btnSim
        {
            padding: 10px 20px;
            background-color: Red;
            color: white;
            border-radius: 10px;
            text-decoration: none;
        }

        .Information
        {
            text-align: center;
        }
    </style>
</head>
<body>
    <main>
        <div class="container">
            <h1>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="WarningIcon" viewBox="0 0 16 16">
            <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
            </svg>
                Confirmação
            </h1>
            <p class="Information">Tem Certeza Que Deseja Deletar o Cliente <br> ID: <strong><?php echo $_GET['Client_ID']; ?></strong> | Nome: <strong><?php echo $_GET['Nome']; ?></strong> ?</p>
            <br><br>

            <div class="Buttons">
                <a href="_Delete.php?Confirmed=1&Request_ID=<?php echo $_GET["Client_ID"]; ?>" class="btnSim">Sim</a>
                <a href="Index.php?Confirmed=0" class="btnNao">Não</a>
            </div>
        </div>

    </main>
</body>
</html>