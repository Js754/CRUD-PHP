<?php 

    $errors = array();

    include "../Includes/Functions.php";

    function ValidateForm($PostData, &$errors)
    {
        $Data = [];

        if(isset($PostData["txtNome"]) && !empty($PostData["txtNome"]))
        {
            $Data["Name"] = filter_var($PostData["txtNome"], FILTER_SANITIZE_SPECIAL_CHARS);
        }
        else
        {
            $errors[] = "Preencha o campo do Nome corretamente!";
        }
        //
        if(isset($PostData["txtCPF"]) && !empty($PostData["txtCPF"]))
        {
            if(mb_strlen($PostData["txtCPF"]) < 11)
            {
                $errors[] = "O CPF precisa conter 11 caracteres totais!";
            }
            else
            {
                $Data["CPF"] = filter_var($PostData["txtCPF"], FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        else
        {
            $errors[] = "Preencha o campo do CPF corretamente!";
        }
        //
        if(isset($PostData["txtCPF"]) && !empty($PostData["txtCPF"]))
        {
            if(mb_strlen($PostData["txtCPF"]) < 11)
            {
                $errors[] = "O CPF precisa conter 11 caracteres totais!";
            }
            else
            {
                $Data["CPF"] = filter_var($PostData["txtCPF"], FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        else
        {
            $errors[] = "Preencha o campo do CPF corretamente!";
        }
        //
        if(isset($PostData["txtCelular"]) && !empty($PostData["txtCelular"]))
        {
            if(mb_strlen($PostData["txtCelular"]) < 11)
            {
                $errors[] = "O Telefone precisa ter no mínimo 11 caracteres!";
            }
            else
            {
                $Data["Celular"] = filter_var($PostData["txtCelular"], FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        else
        {
            $errors[] = "Preencha o campo do CPF corretamente!";
        }
        //
        if(isset($PostData["txtSalario"]) && !empty($PostData["txtSalario"])) 
        {
            $Data['Salario'] = filter_var($PostData["txtSalario"], FILTER_SANITIZE_SPECIAL_CHARS);
        } 
        else 
        {
            $errors[] = "Preencha o campo do Salário corretamente!";
        }
        //
        return $Data;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $DataForm = ValidateForm($_POST, $errors);

        if(empty($errors))
        {
            require_once "../Core/Connection.php";

            try
            {
                $sql = "INSERT INTO Agendamentos SET Data = :Data, Hora = :Hora, Cliente = :Client, Telefone = :Tel, Status = :Status";
                $insert = $PDO->prepare($sql);
                //
                $insert->bindValue(":Data", $Data);
                $insert->bindValue(":Hora", $Hora);
                $insert->bindValue(":Client", $Client);
                $insert->bindValue(":Tel", $Tel);
                $insert->bindValue(":Status", $Status);
                //
                $insert->execute();
            }
            catch (PDOException $error)
            {
                array_push($errors, "Falha Ao Inserir Os Registros Ao Banco de Dados: Erro: " . $error->getMessage());
            }
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