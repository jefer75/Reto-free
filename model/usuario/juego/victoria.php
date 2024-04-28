<?php
    session_start();
    require_once("../../../db/connection.php");
    // include("../../../controller/validarSesion.php");
    $db = new Database();
    $con = $db -> conectar();
    require 'juego.php';

    $fila = $con->prepare("SELECT * FROM salas WHERE num_jug = 1 AND id_sala = $id_sala AND id_estado = 6");
    $fila->execute();
    $ganador = $fila->fetchAll(PDO::FETCH_ASSOC);
                
    foreach($ganador as $fila){
        $username=$fila['username'];
        $kills=$fila['kills'];
        $puntos=$fila['dano_real'];
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganador</title>
</head>
<body>
    
    <div class="Container">

        

    </div>

</body>
</html>