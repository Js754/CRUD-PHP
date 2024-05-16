<?php
    require_once "../Core/Connection.php";

    if(isset($_GET['txtBusca']) and !empty($_GET['txtBusca']))
    {
        $Query = "SELECT * FROM Clientes WHERE Nome LIKE :ClientName";
        $Select = $PDO->prepare($Query);
        //
        $Select->bindValue(":ClientName", "%" . trim($_GET['txtBusca']) ."%");
    }
    else
    {
        $Query = "SELECT * FROM Clientes;";
        //
        $Select = $PDO->prepare($Query);
    }

    if(isset($_GET["Confirmed"]) && ($_GET["Confirmed"]) == 0)
    {
        header("Location: Index.php");
        exit;
    }

    $Select->execute();

    $Rows = $Select->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../CSS/Style.css">
    <title>Clientes</title>
</head>
<body>

    <header>
        <h1>Lista de Clientes</h1>
    </header>

    <?php include "../Includes/Nav.php"; ?>

    <main id="mainIndex">

        <form action="Index.php" method="GET" id="formBusca">
            <label for="txtBusca">Buscar Cliente:</label>
            <input type="text" name="txtBusca" id="txtBusca" value="<?php if(isset($_GET['txtBusca'])) { echo trim($_GET['txtBusca']); }?>">
            <button type="submit">Buscar</button>
        </form>

        <a href="New.php" class="btnNewAgen">Novo Cliente</a>

        <table class="tabela">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Celular</th>
                    <th>Salário</th>
                    <th>Operações</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($Rows As $Result) { ?>
                <tr>
                    <td class="TableRows"><?php echo $Result->Nome;?></td>
                    <td class="TableRows"><?php echo $Result->CPF;?></td>
                    <td class="TableRows"><?php echo $Result->Celular;?></td>
                    <td class="TableRows"><?php echo "R$ " . number_format($Result->Salario, 2, ",", ".");?></td>
                    <td>
                        <div class="divButtons">
                          <a href="Edit.php?Client_ID=<?php echo $Result->ID;?>" class="btnEdit">Editar</a>
                            |
                            <a href="_Delete.php?Client_ID=<?php echo $Result->ID;?>&Nome=<?php echo $Result->Nome;?>" class="btnDelete"><strong>Excluir</strong></a>  
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>

</body>
</html>