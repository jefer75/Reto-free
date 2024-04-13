<?php
    session_start();
    require_once("../../db/connection.php");
    // include("../../../controller/validarSesion.php");
    $db = new Database();
    $con = $db -> conectar();

    $username= $_SESSION['username'];

    if (isset($_POST['abandonar'])){
        
        $con_puntos = $con -> prepare("SELECT * FROM jugadores WHERE username = '$username'");
        $con_puntos -> execute ();
        $puntos = $con_puntos -> fetchAll(PDO::FETCH_ASSOC);

        foreach ($puntos as $fila){
        $puntos = $fila ['puntos'];
        }

        if ($puntos >= 20){
            $actualizado = $puntos - 20;
                    
            $resta_puntos= $con -> prepare ("UPDATE usuarios SET puntos=$actualizado WHERE username = '$username'");
            $resta_puntos -> execute();
        }
        else if ($puntos >= 0 AND $puntos < 20) {
            $actualizado = $puntos - $puntos;
                    
            $resta_puntos= $con -> prepare ("UPDATE usuarios SET puntos=$actualizado WHERE username = '$username'");
            $resta_puntos -> execute();

        }
        
        $abandonar= $con -> prepare ("DELETE FROM jugadores WHERE username = '$username'");
        $abandonar -> execute();
        
        header('location:index.php');
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

                    $query1 = $con -> prepare("SELECT * FROM jugadores WHERE username != '$username'");
                    $query1 -> execute ();
                    $jugadores = $query1 -> fetchAll(PDO::FETCH_ASSOC);

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
                    <td>
                        <a class="hiper" href="" onclick="window.open
                        ('ataca.php?id=<?php echo $username ?>','','width=475, height=215, toolbar=NO'); void(null);">Atacar</a>
                        </td>
                    </tr>
                <?php
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