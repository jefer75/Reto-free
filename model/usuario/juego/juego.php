<?php
    session_start();
    require_once("../../../db/connection.php");
    // include("../../../controller/validarSesion.php");
    $db = new Database();
    $con = $db -> conectar();

    $username= $_SESSION['username'];

        //consulta la sala en la que se encuentra el jugador
        $fila = $con->prepare("SELECT * FROM jugadores WHERE username = '$username'");
        $fila->execute();
        $sala= $fila->fetchAll(PDO::FETCH_ASSOC);
        
            foreach ($sala as $fila) {
            
                //declara las variables del registro que encontro
                $id_sala = $fila['id_sala'];
            }
        
            $con_puntos = $con->prepare("SELECT * FROM usuarios WHERE username = '$username'");
            $con_puntos->execute();
            $puntos_jug= $con_puntos->fetchAll(PDO::FETCH_ASSOC);

            foreach ($puntos_jug as $fila) {
            
                //declara las variables del registro que encontro
                $puntos = $fila['puntos'];
            }

        //consulta el mundo de esa sala
        $con_estado = $con -> prepare("SELECT * FROM salas WHERE id_sala ='$id_sala'");
        $con_estado -> execute ();
        $estados = $con_estado -> fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($estados as $fila){
            $id_mundo= $fila ['id_mundo'];
        }
        
        //condicional para la resta de puntos del jugador
        if ($puntos >= 20){
            $actualizado = $puntos - 20;
        }
        else if ($puntos >= 0 AND $puntos < 20) {
            $actualizado = 0;
        }
    //si escucha un boton llamado abandonar haga
    if (isset($_POST['abandonar'])){
        
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

            if ($num_jug>0){
                //actualiza el numero de jugadores en la sala seleccionada de la tabla salas
                $actualizar_num_jug = $con->prepare("UPDATE salas SET num_jug=$num_jug WHERE id_sala = $id_sala");
                $actualizar_num_jug->execute();
                
            }else {

                $borra_sala= $con -> prepare ("DELETE FROM salas WHERE id_sala = '$id_sala'");
                $borra_sala -> execute();
    
            }
            
            
            //redirecciona al index del usuario
            header('location:index.php');
            
            $abandonar= $con -> prepare ("DELETE FROM jugadores WHERE username = '$username'");
            $abandonar -> execute();

    }

        $con_vida = $con->prepare("SELECT * FROM `jugadores` WHERE username ='$username'");
        $con_vida->execute();
        $vidas = $con_vida->fetchAll(PDO::FETCH_ASSOC);

        foreach ($vidas as $fila) {
            
                    //declara las variables del registro que encontro
            $vida = $fila['vida'];
        }
        
    if ($vida== 0){

        echo"<script>alert('Has quedado eliminado') </script>";
        
        header('location:../inicio/index.php');
        $abandonar -> execute();
    }
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
<body <?php
                        if ($id_mundo==1){
                        echo"class='bermuda'";
                        }
                        else if($id_estado==2){
                            echo"class='purgatorio'";
                        }
                        else if($id_estado==3){
                            echo"class='nexterra'";
                        }
                        else if($id_estado==4){
                            echo"class='alpes'";
                        }
                        else if($id_estado==5){
                            echo"class='kalahari'";
                        }
                        
                    ?>
                    >

    <?php
        $con_vida = $con->prepare("SELECT * FROM `mundos` WHERE id_mundo ='$id_mundo'");
        $con_vida->execute();
        $vidas = $con_vida->fetchAll(PDO::FETCH_ASSOC);
    
            foreach ($vidas as $fila) {
            
                //declara las variables del registro que encontro
                $nomb_mundo = $fila['nomb_mundo'];
            }
    ?>
    
    <h2><?php echo $nomb_mundo?></h2>
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
    $con_jugadores = $con->prepare("SELECT * FROM jugadores WHERE username != '$username' AND id_estado=3");
    $con_jugadores->execute();
    $jugadores = $con_jugadores->fetchAll(PDO::FETCH_ASSOC);

    foreach ($jugadores as $fila){
    $sala=$fila['id_sala'];
    $user=$fila['username'];
    $vida = $fila['vida'];
    $id_estado = $fila['id_estado'];
    $kills = $fila['kills'];

        $mostrar_estado = $con -> prepare("SELECT * FROM estados WHERE id_estado = $id_estado");
        $mostrar_estado -> execute ();
        $estados = $mostrar_estado -> fetchAll(PDO::FETCH_ASSOC);

        foreach ($estados as $fila){
            $estado = $fila ['estado'];
        }
                ?>

                <tr>
                    <td><?php echo $sala?></td>
                    <td><?php echo $user?></td>
                    <td><?php echo $kills?></td>
                    <td><?php echo $estado?></td>
                    <td>
                        <a class="hiper" href="" onclick="window.open
                        ('ataca.php?id=<?php echo $user ?>','','width=475, height=215, toolbar=NO'); void(null);">Atacar</a>
                        </td>
                    </tr>
                
                <?php
                }

                $con_vida = $con->prepare("SELECT * FROM `jugadores` WHERE username ='$username'");
                $con_vida->execute();
                $vidas = $con_vida->fetchAll(PDO::FETCH_ASSOC);

                foreach ($vidas as $fila) {
            
                    //declara las variables del registro que encontro
                    $id_sala = $fila['id_sala'];
                    $vida = $fila['vida'];
                    $puntos = $fila['dano_real'];
                    $kills = $fila['kills'];
                }

                $insertar_datos = $con->prepare("INSERT INTO `partidas`(id_sala, username, puntos, kills) VALUES ($id_sala, '$username', $puntos, $kills)");
                $insertar_datos->execute();

                $abandonar= $con -> prepare ("DELETE FROM jugadores WHERE vida = 0");
                $abandonar -> execute();
                ?>

                <form action="" method="POST">
                    
                    <input type="submit" name="abandonar" value="Abandonar Partida">
                </form>
        </table>
    </div>

</div>
    
</body>
</html>