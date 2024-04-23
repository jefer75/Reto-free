<?php
session_start();
require_once "../../db/connection.php";
// include("../../../controller/validarSesion.php");
$db = new Database();
$con = $db->conectar();
?>
                    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jugadores</title>
</head>
<body>

<?php

if (isset($_POST['regresar'])) {
    header('location:index.php');
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
                    <th>Accion</th>
                </thead>
                <?php
                    $query1 = $con->prepare("SELECT * FROM usuarios WHERE id_tipo_user = 2");
                    $query1->execute();
                    $jugadores = $query1->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($jugadores as $fila) {
                        $nombre = $fila['username'];
                        $nivel = $fila['nivel'];
                        $puntos = $fila['puntos'];
                        $id_rango = $fila['id_rango'];
                        $id_estado = $fila['id_estado'];

                        $con_rango = $con->prepare("SELECT * FROM rangos where id_rango <= $id_rango");
                        $con_rango->execute();
                        $rangos = $con_rango->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($rangos as $fila) {
                            $rango= $fila['nomb_rango'];
                        }

                        $con_estado = $con->prepare("SELECT * FROM estados where id_estado <= $id_estado");
                        $con_estado->execute();
                        $estados = $con_estado->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($estados as $fila) {
                            $estado= $fila['estado'];
                        }
        
                ?>
                <tbody>
                    <td><?php echo $nombre ?></td> 
                    <td><?php echo $nivel ?></td>
                    <td><?php echo $puntos ?></td>
                    <td><?php echo $rango ?></td>
                    <td><?php echo $estado ?></td>
                    
                    <td><a class="hiper" href="" onclick="window.open
                ('act_usuarios.php?id=<?php echo $nombre ?>','','width=500, height=400, toolbar=NO'); void(null);">Click Aqui</a></td>
                    
                </tbody>
                <?php
                    }
                ?>
            </table>


        </form>
    </div>
</body>
</html>