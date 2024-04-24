<?php
session_start();
require_once "../../../db/connection.php";
// include("../../../controller/validarSesion.php");
$db = new Database();
$con = $db->conectar();
?>
                    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/armas.css">
    <title>Jugadores</title>
</head>
<body>

<?php

if (isset($_POST['regresar'])) {
    header('location:../inicio/index.php');
}
?>

    <form action="" method="POST">
        <td class="cerrar_sesion">
            <input type="submit" value="Regresar" name="regresar" class="regresar"> 
        </td>
    </form>
    
    <div class="container">
        <form autocomplete="off" name="form_actualizar" method="POST">
            <table>
                <thead>
                    <th>Nombre de jugador</th>
                    <th>Nivel</th>
                    <th>Puntos</th>
                    <th>Rango</th>
                    <th>Estado</th>
                    <th>Imagen</th>
                    <th>Rango minimo</th>
                    <th>Accion</th>
                </thead>
                <?php
                    $query1 = $con->prepare("SELECT * FROM armas");
                    $query1->execute();
                    $armas = $query1->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($armas as $fila) {
                        $id_arma = $fila['id_arma'];
                        $id_tipo_arma = $fila['id_tipo_arma'];
                        $nomb_arma = $fila['nomb_arma'];
                        $daño= $fila['dano'];
                        $cant_balas = $fila['cant_balas'];                        
                        $imagen = $fila['imagen'];
                        $rango = $fila['id_rango'];

                        $con_rango = $con->prepare("SELECT * FROM tipo_armas where id_tipo_arma <= $id_tipo_arma");
                        $con_rango->execute();
                        $rangos = $con_rango->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($rangos as $fila) {
                            $tipo_arma= $fila['tipo_arma'];
                        }
        
                ?>
                <tbody>
                    <td><?php echo $id_arma ?></td> 
                    <td><?php echo $tipo_arma ?></td>
                    <td><?php echo $nomb_arma ?></td>
                    <td><?php echo $daño ?></td>
                    <td><?php echo $cant_balas ?></td>
                    <td><?php echo $imagen ?></td>
                    <td><?php echo $rango ?></td>
                    <td><a class="hiper" href="" onclick="window.open
                ('act_armas.php?id=<?php echo $id_arma ?>','','width=500, height=400, toolbar=NO'); void(null);">Click Aqui</a></td>
                    
                </tbody>
                <?php
                    }
                ?>
            </table>


        </form>
    </div>
</body>
</html>