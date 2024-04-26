<?php
session_start();
require_once "../../../db/connection.php";
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

switch($nivel){
    case 1:
        $tipo_arma=2;        
        break;
    case 2:
        $tipo_arma=4;                
        break;
        case 3:
        $tipo_arma=5;               
        break;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/armas.css">
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
    header('location:../inicio/index.php');
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
                    <th>Imagen</th>
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
                        $daño = $fila['dano'];
                        $imagen = $fila['imagen'];
                        $id_estado = $fila['id_estado'];

                        $act_disponible = $con->prepare("UPDATE `armas` SET id_estado='6' WHERE id_arma > $tipo_arma");
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
                    <td><img src="<?php echo $imagen ?>" width="100"></td>
                    <td
                    <?php
                        if ($id_estado==5){
                            
                        echo"class='estado_'";
                        
                        }
                        else if($id_estado==6){
                            echo"class='estado_red'";
                        }
                    ?>                    
                    ><?php echo $estado ?></td>
                </tr>
                <?php
}
?>

            </table>
        </div>

    </div>

</body>
</html>