<?php
    require_once "../Core/Connection.php";

    $Query = "SELECT * FROM Agendamentos WHERE ID = :ID";
    $Select = $PDO->prepare($Query);
    $Select->bindValue(":ID", $_GET["Agen_ID"]);
    $Select->execute();

    $Result = $Select->fetch();

    if(!isset($_GET["Agen_ID"]))
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
        <h1>Editando Agendamento ID: <?php echo $_GET["Agen_ID"] ?> </h1>
    </header>

    <?php include "../Includes/Nav.php"; ?>

    <main>
        <form action="_Update.php" method="POST">
            <h1>Formulario de Agendamento - Edição</h1>

            <input type="hidden" name="Agen_ID" Value="<?php echo $_GET["Agen_ID"]; ?>">

            <label for="txtData">Data:</label>
            <input type="date" name="txtData" id="txtData" value="<?php echo $Result->Data; ?>">
            
            <label for="txtHora">Hora:</label>
            <input type="time" name="txtHora" id="txtHora" value="<?php echo $Result->Hora; ?>">
            
            <label for="txtCliente">Cliente:</label>
            <input type="text" name="txtCliente" id="txtCliente" placeholder="Nome Do Cliente"  value="<?php echo $Result->Cliente; ?>">
            
            <label for="txtTelefone">Telefone:</label>
            <input type="tel" name="txtTelefone" id="txtTelefone" placeholder="Telefone" value="<?php echo $Result->Telefone; ?>">
            
            <label for="txtStatus">Status:</label>
            <select name="txtStatus" id="txtStatus" value="<?php echo $Result->Status; ?>">
                <option value="">Selecione O Status</option>
                <option value="Pendente" <?php if($Result->Status == "Pendente") { echo "selected"; } ?>>Pendente</option>
                <option value="Confirmado" <?php if($Result->Status == "Confirmado") { echo "selected"; } ?>>Confirmado</option>
                <option value="Finalizado" <?php if($Result->Status == "Finalizado") { echo "selected"; } ?>>Finalizado</option>
            </select>

            <button type="submit">Alterar Agendamento</button>
        </form>
    </main>

    <div class="btnBack">
        <button>Voltar</button>
    </div>

</body>
</html>