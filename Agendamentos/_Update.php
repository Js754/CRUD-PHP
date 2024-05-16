<?php 

    $errors = array();

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST["txtData"]) and !empty($_POST["txtData"]))
        {
            $Data = filter_input(INPUT_POST, "txtData", FILTER_SANITIZE_SPECIAL_CHARS);
        }
        else
        {
            $sv_err = "Preencha O Campo Da Data Corretamente!";
            array_push($errors, $sv_err);
        }
        //
        if(isset($_POST["txtHora"]) and !empty($_POST["txtHora"]))
        {
            $Hora = filter_input(INPUT_POST, "txtHora", FILTER_SANITIZE_SPECIAL_CHARS);
        }
        else
        {
            $sv_err = "Preencha O Campo Da Hora Corretamente!";
            array_push($errors, $sv_err);
        }
        //
        if(isset($_POST["txtCliente"]) and !empty($_POST["txtCliente"]))
        {
            $Client = filter_input(INPUT_POST, "txtCliente", FILTER_SANITIZE_SPECIAL_CHARS);
            //
            if(mb_strlen($_POST["txtCliente"]) < 3)
            {
                $sv_err = "O Nome Do Cliente Precisa Ter No Mínimo 3 Letras!";
                array_push($errors, $sv_err);
            }
        }
        else
        {
            $sv_err = "Preencha O Campo Do Cliente Corretamente!";
            array_push($errors, $sv_err);
        }
        //
        if(isset($_POST["txtTelefone"]) and !empty($_POST["txtTelefone"]))
        {
            $Tel = filter_input(INPUT_POST, "txtTelefone", FILTER_SANITIZE_SPECIAL_CHARS);
        }
        else
        {
            $sv_err = "Preencha O Campo do Telefone Corretamente!";
            array_push($errors, $sv_err);
        }
        //
        if(isset($_POST["txtStatus"]) and !empty($_POST["txtStatus"]))
        {
            $Status = filter_input(INPUT_POST, "txtStatus", FILTER_SANITIZE_SPECIAL_CHARS);
        }
        else
        {
            $sv_err = "Preencha O Campo Do Status Corretamente!";
            array_push($errors, $sv_err);
        }
    }
    else
    {
        $sv_err = "Método De Requisição Inválido! Use o Método: (POST)";
        array_push($errors, $sv_err);
    }

    if(count($errors) == 0)
    {
        require_once "../Core/Connection.php";

        try
        {
            $sql = "UPDATE Agendamentos SET Data = :Data, Hora = :Hora, Cliente = :Client, Telefone = :Tel, Status = :Status WHERE ID = :ID";
            $Update = $PDO->prepare($sql);
            //
            $Update->bindValue(":Data", $Data);
            $Update->bindValue(":Hora", $Hora);
            $Update->bindValue(":Client", $Client);
            $Update->bindValue(":Tel", $Tel);
            $Update->bindValue(":Status", $Status);
            $Update->bindValue(":ID", $_POST["Agen_ID"]);
            //
            if($Update->execute())
            {  
                header("Location: Index.php");
            }
        }
        catch (PDOException $error)
        {
            array_push($errors, "Falha Ao Atualizar Os Registros Ao Banco de Dados: Erro: " . $error->getMessage());
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erro</title>

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

        .DivErrors
        {
            background-color: whitesmoke;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-weight:bold;
            display: flex;
            justify-content: center;
            align-items: center;
            list-style-type: none;
            color:red;
            padding: 5px 8px;
        }
    </style>
</head>
<body>
    <main>
        <div class="container">
            <h1>Erro</h1>
            <p>Erros Ocorridos:</p>
        </div>
        
        <div class="DivErrors">
            <ul>
                <?php foreach($errors As $Error) { ?>
                    <li>-> <?php echo $Error; ?></li>
                <?php } ?>
            </ul>
        </div>

        <a href="javascript:history.back();">Voltar</a>
    </main>
</body>
</html>