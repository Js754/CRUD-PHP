<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../CSS/Style.css">
    <title>Novo Cliente</title>
</head>
<body>

    <header>
        <h1>Novo Cliente</h1>
    </header>

    <?php include "../Includes/Nav.php"; ?>

    <main>
        <form action="_Insert.php" method="POST">
            <h1>Formulario de Inscrição Para Clientes</h1>

            <label for="txtNome">Nome:</label>
            <input type="text" name="txtNome" id="txtNome">
            
            <label for="txtCPF">CPF:</label>
            <input type="text" name="txtCPF" id="txtCPF">
            
            <label for="txtCelular">Celular:</label>
            <input type="text" name="txtCelular" id="txtCelular" placeholder="Telefone">
            
            <label for="txtSalario">Salario:</label>
            <input type="text" name="txtSalario" id="txtSalario" placeholder="Salário">
            
            <button type="submit">Salvar</button>
        </form>
    </main>

</body>
</html>