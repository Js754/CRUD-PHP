<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../CSS/Style.css">
    <title>Novo Agendamento</title>
</head>
<body>

    <header>
        <h1>Novo Agendamento</h1>
    </header>

    <?php include "../Includes/Nav.php"; ?>

    <main>
        <form action="_Insert.php" method="POST">
            <h1>Formulario de Agendamento</h1>

            <label for="txtData">Data:</label>
            <input type="date" name="txtData" id="txtData">
            
            <label for="txtHora">Hora:</label>
            <input type="time" name="txtHora" id="txtHora">
            
            <label for="txtCliente">Cliente:</label>
            <input type="text" name="txtCliente" id="txtCliente" placeholder="Nome Do Cliente">
            
            <label for="txtTelefone">Telefone:</label>
            <input type="tel" name="txtTelefone" id="txtTelefone" placeholder="Telefone">
            
            <label for="txtStatus">Status:</label>
            <select name="txtStatus" id="txtStatus">
                <option value="">Selecione O Status</option>
                <option value="Pendente">Pendente</option>
                <option value="Confirmado">Confirmado</option>
                <option value="Finalizado">Finalizado</option>
            </select>

            <button type="submit">Salvar</button>
        </form>
    </main>

</body>
</html>