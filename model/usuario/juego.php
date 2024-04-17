<?php
    session_start();
    require_once("../../db/connection.php");
    // include("../../../controller/validarSesion.php");
    $db = new Database();
    $con = $db -> conectar();

    $username= $_SESSION['username'];

    
    

    if (isset($_POST['abandonar'])){
        
        //consulta el jugador en la tabla jugadores
    $con_puntos = $con -> prepare("SELECT * FROM jugadores WHERE username = '$username'");
    $con_puntos -> execute ();
    $datos = $con_puntos -> fetchAll(PDO::FETCH_ASSOC);
    
    //declara las variables

        foreach ($datos as $fila){
            $puntos = $fila ['puntos'];
            $id_sala = $fila ['id_sala'];
            }
        //condicional para la resta de puntos del jugador
        if ($puntos >= 20){
            $actualizado = $puntos - 20;
        }
        else if ($puntos >= 0 AND $puntos < 20) {
            $actualizado = $puntos - $puntos;
        }
        
        //actualiza la cantidad de puntos del jugador en su perfil
        $resta_puntos= $con -> prepare ("UPDATE usuarios SET puntos=$actualizado WHERE username = '$username'");
        $resta_puntos -> execute();

        //consulta la sala en la que se encuentra el jugador
        $fila = $con->prepare("SELECT * FROM `salas` WHERE id_sala = $id_sala");
        $fila->execute();
        $numero_jugadores = $fila->fetchAll(PDO::FETCH_ASSOC);

            foreach ($numero_jugadores as $fila) {
            
                //declara las variables del registro que encontro
                $id_sala = $fila['id_sala'];
                $num_jug = $fila['num_jug'];
    
            }

            $num_jug = $num_jug - 1;

            //actualiza el numero de jugadores en la sala seleccionada de la tabla salas
            $actualizar_num_jug = $con->prepare("UPDATE salas SET num_jug=$num_jug WHERE id_sala = $id_sala");
            $actualizar_num_jug->execute();
        
            //redirecciona al index del usuario
            header('location:index.php');
        

        $abandonar= $con -> prepare ("DELETE FROM jugadores WHERE username = '$username'");
        $abandonar -> execute();
    }

    $con_puntos = $con -> prepare("SELECT * FROM jugadores WHERE username = '$username'");
    $con_puntos -> execute ();
    $datos = $con_puntos -> fetchAll(PDO::FETCH_ASSOC);
    foreach ($datos as $fila) {
            
        //declara las variables del registro que encontro
        $id_sala = $fila['id_sala'];
    }

    $query1 = $con -> prepare("SELECT * FROM jugadores WHERE username != '$username' AND id_sala = $id_sala");
    $query1 -> execute ();
    $jugadores = $query1 -> fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script>
        // Función para recargar la página principal cuando la ventana emergente se cierra
        function recargarPaginaPrincipal() {
            location.reload(); // Recarga la página principal
        }
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juega</title>
</head>
<body>

    <div class="container">

        <div class="tabla">
            <table>
                <tr>
                    <th>Nombre del jugador</th>
                    <th>vida</th>
                    <th>Arma</th>
                    <th>Estado</th>
                    <th>Accion</th>
                </tr>
                
                <?php

                    
                    foreach ($jugadores as $fila){
                        
                    $username=$fila['username'];
                    $id_arma = $fila ['id_arma'];
                    $vida = $fila['vida'];
                    $id_estado = $fila['id_estado'];

                        $mostrar_arma = $con -> prepare("SELECT * FROM armas WHERE id_arma = $id_arma");
                        $mostrar_arma -> execute ();
                        $armas = $mostrar_arma -> fetchAll(PDO::FETCH_ASSOC);

                        foreach ($armas as $fila){
                            $arma = $fila ['nomb_arma'];
                        }

                        $mostrar_estado = $con -> prepare("SELECT * FROM estados WHERE id_estado = $id_estado");
                        $mostrar_estado -> execute ();
                        $estados = $mostrar_estado -> fetchAll(PDO::FETCH_ASSOC);

                        foreach ($estados as $fila){
                            $estado = $fila ['estado'];
                        }
                ?>

                <tr>
                    <td><?php echo $username?></td>
                    <td id="campo_vida"><?php echo $vida?></td>
                    <td><?php echo $arma?></td>
                    <td id="campo_estado"><?php echo $estado?></td>
                    <?php 
                    
                    if($estado=3){
                        echo "
                        ?>
                    <td>
                        <a class="hiper" href="' onclick="window.open
                        ('<script>ataca.php?id=<?php echo $username ?>','','width=475, height=250, toolbar=NO</script>'); void(null);">Atacar</a>
                        </td>
                    </tr>
                "
                    }
                }
                ?>

                <form action="" method="POST">
                    
                    <input type="submit" name="abandonar" value="Abandonar Partida">
                </form>
        </table>
    </div>

</div>
    
</body>
</html>