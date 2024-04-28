<?php
    session_start();
    require_once("../../../db/connection.php");
    // include("../../../controller/validarSesion.php");
    $db = new Database();
    $con = $db -> conectar();

    $username= $_SESSION['username'];
    
        //consulta los puntos que tiene el jugador en su perfil
        $con_puntos = $con->prepare("SELECT * FROM usuarios WHERE username = '$username'");
        $con_puntos->execute();
        $puntos_jug= $con_puntos->fetchAll(PDO::FETCH_ASSOC);

        foreach ($puntos_jug as $fila) {
        
            //declara la variable puntos, que es donde va a quedar el puntaje del usuario
            $puntos = $fila['puntos'];
        }

        //consulta la sala en la que se encuentra el jugador
        $fila = $con->prepare("SELECT * FROM jugadores WHERE username = '$username'");
        $fila->execute();
        $sala= $fila->fetchAll(PDO::FETCH_ASSOC);
        
            foreach ($sala as $fila) {
            
                //declara la sala donde esta el jugador
                $id_sala = $fila['id_sala'];
            }
        //consulta el mundo de esa sala
        $con_estado = $con -> prepare("SELECT salas.id_sala, salas.id_mundo, salas.num_jug, salas.id_estado, mundos.id_mundo, mundos.nomb_mundo, jugadores.vida, jugadores.dano_real, jugadores.kills FROM salas 
        inner JOIN mundos ON salas.id_mundo = mundos.id_mundo 
        inner JOIN jugadores ON jugadores.username = '$username' WHERE salas.id_sala='$id_sala'");
        
        $con_estado -> execute ();
        $estados = $con_estado -> fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($estados as $fila){
            //consulta el mundo y su nombre
            $id_mundo= $fila ['id_mundo'];
            $nomb_mundo= $fila ['nomb_mundo'];
            $num_jug= $fila ['num_jug'];
            $id_estado= $fila ['id_estado'];
            
            $vida = $fila['vida'];
            $puntos_part = $fila['dano_real'];
            $kills_part=$fila['kills'];
        }
        
        if($num_jug==5){
            $actualizar_num_jug = $con->prepare("UPDATE salas SET id_estado=6 WHERE id_sala = $id_sala");
            $actualizar_num_jug->execute();
        }

    //si escucha un boton llamado abandonar haga
    $num_jug_act = $num_jug-1;
    if (isset($_POST['abandonar'])){

            if($vida > 0){
                //actualiza el numero de jugadores en la sala seleccionada de la tabla salas
                $actualizar_num_jug = $con->prepare("UPDATE salas SET num_jug=$num_jug_act WHERE id_sala = $id_sala");
                $actualizar_num_jug->execute();
            }

            $con_estado -> execute ();
            $estados = $con_estado -> fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($estados as $fila){
                //consulta el mundo y su nombre
                $num_jug= $fila ['num_jug'];
            }

            if($num_jug == 0) {

                $borra_sala= $con -> prepare ("DELETE FROM salas WHERE id_sala = '$id_sala'");
                $borra_sala -> execute();

            }
            
            $puntos_kill=$kills*5;
            $puntos_act= $puntos +$daño;

            $insertar_datos = $con->prepare("INSERT INTO `partidas`(id_sala, username, puntos, kills, id_mundo) VALUES ($id_sala, '$username', $puntos_act + $puntos_kill, $kills_part, $id_mundo)");
            $insertar_datos->execute();
            
            //redirecciona al index del usuario
            header('location:../inicio/index.php');
            
            $abandonar= $con -> prepare ("DELETE FROM jugadores WHERE username = '$username'");
            $abandonar -> execute();
            
    }
    if ($vida== 0){        

        echo '<script> alert ("Has quedado eliminad@");</script>';
        $actualizar_num_jug = $con->prepare("UPDATE salas SET num_jug=$num_jug_act WHERE id_sala = $id_sala");
        $actualizar_num_jug->execute();
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/juego.css">
    <title>Juega</title>
</head>
<body>

    <form action="" method="POST">
                    
        <input type="submit" name="abandonar" value="Abandonar Partida">
    </form>
    
    <h2><?php echo $nomb_mundo?></h2>
    <h4><?php echo $vida?></h4>
    <div class="container">

        <div class="tabla">
            <table>
                <tr>
                    <th>Sala</th>
                    <th>Nombre del jugador</th>
                    <th>Kills</th>
                    <th>Estado</th>
                    <th>Accion</th>
                </tr>
                
                <?php
                    $con_jugadores = $con->prepare("SELECT jugadores.id_sala, jugadores.username, jugadores.vida, jugadores.kills, jugadores.id_estado, estados.estado FROM jugadores inner JOIN estados ON jugadores.id_estado = estados.id_estado WHERE jugadores.username !='$username' AND jugadores.id_estado=3 AND id_sala = $id_sala");
                    $con_jugadores->execute();
                    $jugadores = $con_jugadores->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($jugadores as $fila){
                    $sala=$fila['id_sala'];
                    $user=$fila['username'];
                    $kills = $fila['kills'];
                    $estado = $fila ['estado'];
                        
                ?>

                <tr>
                    <td><?php echo $sala?></td>
                    <td><?php echo $user?></td>
                    <td><?php echo $kills?></td>
                    <td><?php echo $estado?></td>
                    <td>
                    <?php
               
                    //si encuentra una sala, ejecute....
                        if ($vida > 0 AND $id_estado == 6){
                        
                    ?>

                        <a class="hiper" href="" onclick="window.open
                        ('ataca.php?id=<?php echo $user ?>','','width=475, height=215, toolbar=NO'); void(null);">Atacar</a>
                        </td>
                    </tr>
                
                <?php
                } 

                }

                $fila = $con->prepare("SELECT jugadores.id_sala, jugadores.username, jugadores.vida, jugadores.id_estado FROM salas inner JOIN jugadores ON jugadores.id_sala = salas.id_sala WHERE jugadores.id_estado = 3 AND salas.id_sala = $id_sala AND salas.id_estado=6 AND salas.num_jug=1");
                $fila->execute();
                $ganador = $fila->fetchAll(PDO::FETCH_ASSOC);
                
                //si encuentra una sala, ejecute....
                if ($ganador){
                    header('location:victoria.php');
                }
                ?>
                
        </table>
    </div>

</div>
    
</body>
</html>