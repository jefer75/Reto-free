<?php
    session_start();
    require_once("../../db/connection.php");
    // include("../../../controller/validarSesion.php");
    $db = new Database();
    $con = $db -> conectar();

    $username= $_SESSION['username'];


    $query1 = $con -> prepare("SELECT * FROM jugadores WHERE username = '$username'");
    $query1 -> execute ();
    $reg_vida = $query1 -> fetchAll(PDO::FETCH_ASSOC);

    foreach ($reg_vida as $fila){
        $vida=$fila['vida'];
        $arma=$fila['id_arma'];   
    }

    if ($vida >= 0){
        $estado = 3;
    }
    else if($vida <= 0){
        $estado = 4;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
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
                    <th>Accion</th>
                </tr>
                
                <?php

                    


                    $query1 = $con -> prepare("SELECT * FROM jugadores");
                    $query1 -> execute ();
                    $jugadores = $query1 -> fetchAll(PDO::FETCH_ASSOC);

                    foreach ($jugadores as $fila){
                    $id_arma = $fila ['id_arma'];
                    
                ?>

                <tr>
                    <td><?php echo $fila['username']?></td>
                    <td><?php echo $fila['vida']?></td>

                    <?php
                    $mostrar_arma = $con -> prepare("SELECT * FROM armas WHERE id_arma = $id_arma");
                    $mostrar_arma -> execute ();
                    $armas = $mostrar_arma -> fetchAll(PDO::FETCH_ASSOC);

                    foreach ($armas as $fila){
                        $arma = $fila ['nomb_arma'];
                    }
                        
                ?>
                    <td><?php echo $arma?></td>
                    <td><input type="submit" name="atacar" id="atacar" value="atacar">

                    </td>
                </tr>
                <?php
                    
                }
                ?>

        </table>
    </div>

</div>
    
</body>
</html>