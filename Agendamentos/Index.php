<?php
    require_once "../Core/Connection.php";

    if(isset($_GET['txtBusca']) and !empty($_GET['txtBusca']))
    {
        $Query = "SELECT * FROM Agendamentos WHERE Cliente LIKE :cliente";
        $Select = $PDO->prepare($Query);
        //
        $Select->bindValue(":cliente", "%" . trim($_GET['txtBusca']) ."%");
    }
    else
    {
        $Query = "SELECT * FROM Agendamentos;";
        //
        $Select = $PDO->prepare($Query);
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
    <title>Agendamentos</title>
</head>
<body>

    <header>
        <h1>Lista de Agendamentos</h1>
    </header>

    <?php include "../Includes/Nav.php"; ?>

    <main id="mainIndex">

        <form action="Index.php" method="GET" id="formBusca">
            <label for="txtBusca">Buscar Agendamento:</label>
            <input type="text" name="txtBusca" id="txtBusca" value="<?php if(isset($_GET['txtBusca'])) { echo trim($_GET['txtBusca']); }?>">
            <button type="submit">Buscar</button>
        </form>

        <a href="New.php" class="btnNewAgen">Novo Agendamento</a>

        <table class="tabela">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Cliente</th>
                    <th>Telefone</th>
                    <th>Status</th>
                    <th>Operações</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($Rows As $Result) { ?>
                <tr>
                    <?php 
                        $FixData = explode("-", $Result->Data);
                    ?>

                    <td><?php echo $FixData[2] . "/" . $FixData[1] . "/" . $FixData[0];?></td>
                    <td><?php echo $Result->Hora;?></td>
                    <td><?php echo $Result->Cliente;?></td>
                    <td><?php echo $Result->Telefone;?></td>
                    <td><?php echo $Result->Status;?></td>
                    <td>
                        <div class="divButtons">
                          <a href="Edit.php?Agen_ID=<?php echo $Result->ID;?>" class="btnEdit">Editar</a>
                            |
                            <a href="_Delete.php?Agen_ID=<?php echo $Result->ID;?>&Nome=<?php echo $Result->Cliente;?>" class="btnDelete"><strong>Excluir</strong></a>  
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>

</body>
</html>