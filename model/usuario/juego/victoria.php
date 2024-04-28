<?php
    session_start();
    require_once("../../../db/connection.php");
    // include("../../../controller/validarSesion.php");
    $db = new Database();
    $con = $db -> conectar();

    
$username = $_SESSION['username'];

    $fila = $con->prepare("SELECT jugadores.id_sala, jugadores.username, jugadores.kills, jugadores.dano_real, avatares.imagen FROM jugadores inner JOIN usuarios ON usuarios.username = jugadores.username INNER JOIN avatares ON usuarios.id_avatar = avatares.id_avatar");
    $fila->execute();
    $ganador = $fila->fetchAll(PDO::FETCH_ASSOC);
                
    foreach($ganador as $fila){
        $id_sala=$fila['id_sala'];
        $ganador=$fila['username'];
        $kills=$fila['kills'];
        $puntos=$fila['dano_real'];
        $avatar=$fila['imagen'];
    }

    $fila = $con->prepare("SELECT * FROM salas WHERE id_sala == $id_sala");
    $fila->execute();
    $ganador = $fila->fetchAll(PDO::FETCH_ASSOC);
                
    foreach($ganador as $fila){
        $id_mundo=$fila['id_mundo'];
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/victoria.css">
    <title>Ganador</title>
</head>
<body>
    <header>
        <div class="menu-container">    
            <h1>GANADOR  <?php echo $ganador?></h1>
            
        <form action="" method="POST">
        <td>
            <input type="submit" value="Salir a lobby" name="regresar" id="cerrar_sesion">
        </td>
        
        </tr>
        </form>
        </div>
        <?php

if (isset($_POST['regresar'])) {

    $puntos_kill=$kills*5;

    $insertar_partida= $con -> prepare ("INSERT INTO `partidas`(id_sala, username, puntos, kills, id_mundo) VALUES ($id_sala, '$username', $puntos+$puntos_kill, $kills, $id_mundo)");
    $insertar_partida -> execute();

    $abandonar= $con -> prepare ("DELETE FROM jugadores WHERE username = '$username'");
    $abandonar -> execute();

    $abandonar= $con -> prepare ("DELETE FROM salas WHERE id_sala = '$id_sala'");
    $abandonar -> execute();

    header('location:../inicio/index.php');
}

?>
    </header>    

    
        
    
    <div class="Container">
        <img src="<?php echo $avatar?>" alt="">

        <div class="table">
            <table>
                <thead>
                    <th>Kills</th>
                    <th>Puntos obtenidos</th>
                </thead>
                <tbody>
                    <td><?php echo $kills?></td>
                    <td><?php echo $puntos?></td>
                </tbody>
                
            </table>
        </div>
    </div>

</body>
</html>