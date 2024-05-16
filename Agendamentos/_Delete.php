<?php 
    require_once "../Core/Connection.php";

    if(isset($_GET["Confirmed"]) and ($_GET["Confirmed"]) == 1)
    {
        $sql = "DELETE FROM Agendamentos WHERE ID = :RequestID;";
        //
        $Delete = $PDO->prepare($sql);
        $Delete->bindValue(":RequestID", $_GET['Agen_ID']);
        $Delete->execute();

        //Redirect To Index.php
        header("Location: Index.php");
    }
    else if(isset($_GET["Confirmed"]) and ($_GET["Confirmed"]) == 0)
    {
        
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
            background-color: #333;
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
    </style>
</head>
<body>
    <main>
        <div class="container">
            <h1>Confirmação</h1>
            <p>Tem Certeza Que Deseja Deletar o Agendamento ID: <strong><?php echo $_GET['Agen_ID']; ?></strong> |  Nome: <strong><?php echo $_GET['Nome']; ?></strong> ?</p>
            <br><br>

            <div class="Buttons">
                <a href="_Delete.php?Confirmed=1&Req_ID="<?php echo $_GET['Agen_ID']; ?>" class="btnSim">Sim</a>
                <a href="Index.php?Confirmed=0" class="btnNao">Não</a>
            </div>
        </div>

    </main>
</body>
</html>