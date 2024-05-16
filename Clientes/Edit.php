<?php
    require_once "../Core/Connection.php";

    $Query = "SELECT * FROM Clientes WHERE ID = :ID";
    $Select = $PDO->prepare($Query);
    $Select->bindValue(":ID", $_GET["Client_ID"]);
    $Select->execute();

    $Result = $Select->fetch();

    if(!isset($_GET["Client_ID"]))
    {
        array_push($Errors, "Insira O ID Do Agendamento");
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../CSS/Style.css">
    <title>Editar Agendamento</title>
</head>
<body>

    <header>
        <h1>Editando Agendamento ID: <?php echo $_GET["Client_ID"] ?> </h1>
    </header>

    <?php include "../Includes/Nav.php"; ?>

    <main>
        <form action="_Update.php" method="POST">
            <h1>Formulario de Agendamento - Edição</h1>

            <input type="hidden" name="Client_ID" Value="<?php echo $_GET["Client_ID"]; ?>">

            <label for="txtNome">Nome:</label>
            <input type="text" name="txtNome" id="txtNome" value="<?php echo $Result->Nome; ?>">
            
            <label for="txtCPF">CPF:</label>
            <input type="text" name="txtCPF" id="txtCPF" value="<?php echo $Result->CPF; ?>">
            
            <label for="txtCelular">Celular:</label>
            <input type="text" name="txtCelular" id="txtCelular" placeholder="Telefone" value="<?php echo $Result->Celular; ?>">
            
            <label for="txtSalario">Salario:</label>
            <input type="text" name="txtSalario" id="txtSalario" placeholder="Salário" value="<?php echo $Result->Salario; ?>">

            <button type="submit">Alterar Cliente</button>
        </form>
    </main>

    <div class="btnBack">
        <button>Voltar</button>
    </div>

</body>
</html>