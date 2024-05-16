<?php 

    $errors = array();

    function FormatCPF($value)
    {
        $CPF_LENGTH = 11;
        $cnpj_cpf = preg_replace("/\D/", '', $value);
        
        if (strlen($cnpj_cpf) === $CPF_LENGTH) {
            return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cnpj_cpf);
        } 
        
        return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj_cpf);
    }

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST["txtNome"]) and !empty($_POST["txtNome"]))
        {
            $Name = filter_input(INPUT_POST, "txtNome", FILTER_SANITIZE_SPECIAL_CHARS);
        }
        else
        {
            $sv_err = "Preencha O Campo Do Nome Corretamente!";
            array_push($errors, $sv_err);
        }
        //
        if(isset($_POST["txtCPF"]) and !empty($_POST["txtCPF"]))
        {
            $CPF = filter_input(INPUT_POST, "txtCPF", FILTER_SANITIZE_SPECIAL_CHARS);
            //
            if(mb_strlen($_POST["txtCPF"]) < 11)
            {
                $sv_err = "O CPF Precisa Conter 11 Caracteres Totais!";
                array_push($errors, $sv_err);
            }
        }
        else
        {
            $sv_err = "Preencha O Campo Do CPF Corretamente!";
            array_push($errors, $sv_err);
        }
        //
        if(isset($_POST["txtCelular"]) and !empty($_POST["txtCelular"]))
        {
            $Tel = filter_input(INPUT_POST, "txtCelular", FILTER_SANITIZE_SPECIAL_CHARS);
            //
            if(mb_strlen($_POST["txtCelular"]) < 11)
            {
                $sv_err = "O Telefone Precisa Ter No Mínimo 11 Caracteres!";
                array_push($errors, $sv_err);
            }
        }
        else
        {
            $sv_err = "Preencha O Campo Do Cliente Corretamente!";
            array_push($errors, $sv_err);
        }
        //
        if(isset($_POST["txtSalario"]) and !empty($_POST["txtSalario"]))
        {
            $Salario = filter_input(INPUT_POST, "txtSalario", FILTER_SANITIZE_SPECIAL_CHARS);
        }
        else
        {
            $sv_err = "Preencha O Campo do Salario Corretamente!";
            array_push($errors, $sv_err);
        }
        //
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
            $sql = "UPDATE Clientes SET Nome = :Nome, CPF = :CPF, Celular = :Tel, Salario = :Salario WHERE ID = :ID";
            $Update = $PDO->prepare($sql);
            //
            $Update->bindValue(":Nome", $Name);
            $Update->bindValue(":CPF", FormatCPF($CPF));
            $Update->bindValue(":Tel", $Tel);
            $Update->bindValue(":Salario", $Salario);
            $Update->bindValue(":ID", $_POST["Client_ID"]);
            //
            if($Update->execute())
            { 
                header("Location: Index.php");
                exit;
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