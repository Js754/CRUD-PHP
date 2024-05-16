<?php 

    $errors = array();
    setlocale(LC_ALL, 'pt_BR');

    function FormatCPF($value)
    {
        $CPF_LENGTH = 11;
        $cnpj_cpf = preg_replace("/\D/", '', $value);
        
        if (strlen($cnpj_cpf) === $CPF_LENGTH) {
            return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cnpj_cpf);
        } 
        
        return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj_cpf);
    }

    function FormatCell($numero)
    {
        if(strlen($numero) == 10)
        {
            $novo = substr_replace($numero, '(', 0, 0);
            $novo = substr_replace($novo, '9', 3, 0);
            $novo = substr_replace($novo, ')', 3, 0);
        }
        else
        {
            $novo = substr_replace($numero, '(', 0, 0);
            $novo = substr_replace($novo, ')', 3, 0);
        }
        return $novo;
    }

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
                $sql = "INSERT INTO Clientes (Nome, CPF, Celular, Salario) VALUES (:Nome, :CPF, :Celular, :Salario)";
                $insert = $PDO->prepare($sql);
    
                $insert->bindValue(":Nome", $DataForm['Name']);
                $insert->bindValue(":CPF", FormatCPF($DataForm['CPF']));
                $insert->bindValue(":Celular", FormatCell($DataForm['Celular']));
                $insert->bindValue(":Salario", $DataForm['Salario']);
    
                if ($insert->execute()) 
                {
                    header("Location: Index.php");
                    exit;
                }
            } 
            catch (PDOException $error) 
            {
                $errors[] = "Falha ao inserir os registros no banco de dados: Erro: " . $error->getMessage();
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
            background-color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-weight: bold;
            display: flex;
            justify-content: center;
            align-items: center;
            color: red;
            padding: 5px 8px;
        }
        .btnBack
        {
            list-style-type: none;
            display: flex;
            color: blue;
            font-weight: bold;
            justify-content: center;
            margin-top: 25px;
        }
    </style>
</head>
<body>
    <main>
        <div class="container">
            <h1>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="ErrTriangle" viewBox="0 0 16 16">
                <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.15.15 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.2.2 0 0 1-.054.06.1.1 0 0 1-.066.017H1.146a.1.1 0 0 1-.066-.017.2.2 0 0 1-.054-.06.18.18 0 0 1 .002-.183L7.884 2.073a.15.15 0 0 1 .054-.057m1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767z"/>
                <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
            </svg>
                Erro
            </h1>
            <p>Erros Ocorridos:</p>
        </div>
        
        <div class="DivErrors">
            <ul>
                <?php foreach($errors As $Error) { ?>
                    <li class="ListErrors"><?php echo $Error; ?></li>
                <?php } ?>
            </ul>
        </div>

        <a href="javascript:history.back();" class="btnBack">Voltar</a>
    </main>
</body>
</html>