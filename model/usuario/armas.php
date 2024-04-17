<?php
session_start();
require_once "../../db/connection.php";
// include("../../../controller/validarSesion.php");
$db = new Database();
$con = $db->conectar();

$username = $_SESSION['username'];

$query = $con->prepare("SELECT * FROM usuarios Where username='$username'");
$query->execute();
$resultados = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($resultados as $fila) {
    $nivel = $fila['nivel'];
}

if ($nivel <= 4) {
    $tipo_arma = 3;
} else if ($nivel >= 5 and $nivel <= 9) {
    $tipo_arma = 6;
} else if ($nivel >= 10 and $nivel <= 14) {
    $tipo_arma = 9;
} else if ($nivel >= 15 and $nivel <= 19) {
    $tipo_arma = 12;
} else if ($nivel >= 20 and $nivel <= 24) {
    $tipo_arma = 15;
} else if ($nivel >= 25 and $nivel <= 29) {
    $tipo_arma = 18;
}  else if ($nivel > 29) {
    $tipo_arma = 21;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Armas</title>
</head>
<body>

<header>
        <form action="" method="POST">

        <td>

            <input type="submit" value="Regresar" name="regresar" id="regresar">
        </td>

        </tr>
        </form>
        <?php

if (isset($_POST['regresar'])) {
    header('location:index.php');
}

?>
    </header>

    <div class="container">

        <div class="tabla">
            <table>
                <tr>
                    <th>Nombre de arma</th>
                    <th>Tipo de arma</th>
                    <th>Cantidad de balas</th>
                    <th>Daño</th>
                    <th>Arma</th>
                    <th>Estado</th>
                </tr>

                <?php
                    $query1 = $con->prepare("SELECT * FROM armas");
                    $query1->execute();
                    $arma = $query1->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($arma as $fila) {
                        $nombre = $fila['nomb_arma'];
                        $id_tipo_armas = $fila['id_tipo_arma'];
                        $cant_balas = $fila['cant_balas'];
                        $daño = $fila['daño'];
                        $arma = $fila['arma'];
                        $id_estado = $fila['id_estado'];

                        $act_disponible = $con->prepare("UPDATE `armas` SET id_estado='5' WHERE id_arma <= $tipo_arma");
                        $act_disponible->execute();

                        $tipo = $con->prepare("SELECT * FROM tipo_armas where id_tipo_arma <= $id_tipo_armas");
                        $tipo->execute();
                        $tipos = $tipo->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($tipos as $fila) {
                            $tipo = $fila['tipo_arma'];
                        }
                        $con_estado = $con->prepare("SELECT * FROM estados where id_estado <= $id_estado");
                        $con_estado->execute();
                        $estados = $con_estado->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($estados as $fila) {
                            $estado= $fila['estado'];
                        }
    
    ?>

                <tr>
                    <td><?php echo $nombre ?></td>
                    <td><?php echo $tipo ?></td>
                    <td><?php echo $cant_balas ?></td>
                    <td><?php echo $daño ?></td>
                    <td><?php echo $arma ?></td>
                    <td><?php echo $estado ?></td>
                </tr>
                <?php
}
?>

            </table>
        </div>

    </div>

</body>
</html>