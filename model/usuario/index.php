<?php
    session_start();
    require_once("../../db/connection.php");
    // include("../../../controller/validarSesion.php");
    $db = new Database();
    $con = $db -> conectar();

    $username= $_SESSION['username'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="../../css/index_usu.css">
</head>
<body>
    <div class="container">
        <?php

            $query = $con -> prepare("SELECT * FROM usuarios Where username='$username'");
            $query -> execute ();
            $resultados = $query -> fetchAll(PDO::FETCH_ASSOC);

            foreach ($resultados as $fila){
                
            $id_avatar=$fila['id_avatar'];
            $username=$fila['username'];
            $nivel=$fila['nivel'];
            $id_rango=$fila['id_rango'];

                $query1 = $con -> prepare("SELECT * FROM avatares where id_avatar =$id_avatar");
                $query1 -> execute ();
                $avatar = $query1 -> fetchAll(PDO::FETCH_ASSOC);
                foreach ($avatar as $fila){

                $avatar=$fila['avatar'];
                }

                $query2 = $con -> prepare("SELECT * FROM rangos where id_rango =$id_rango");
                $query2 -> execute ();
                $rango = $query2 -> fetchAll(PDO::FETCH_ASSOC);
                foreach ($rango as $fila){

                $rango=$fila['rango'];
                }
            }
        ?>
        <div class="perfil">
            <p><?php echo $avatar; ?></p>
            <h4><?php echo $username; ?></h4>
            <p><?php echo $nivel; ?></p>
            <p><?php echo $rango; ?></p>
        </div>

        <div class="menu">
            <a href="reportes.php" class="btn">Resultados</a>
            <a href="armas.php" class="btn">Armas</a>
            <a href="mapas.php" class="btn">Jugar</a>
            <a href="juego.php" class="btn_jugar">Jugar</a>
        </div>


        <div class="carrusel">
            <div class="image-box">
            <div class="image">
                <img class="img1" src="../../img/mapas/bermuda.jpg" alt="">
            </div>
            <div class="image">
                <img class="img2" src="../../img/mapas/alpes.jpg" alt="">
            </div>
            <div class="image">
                <img class="img3" src="../../img/mapas/purgatorio.jpg" alt="">
            </div>
            <div class="image">
                <img class="img4" src="../../img/mapas/kalahari.jpg" alt="">
            </div>
            <div class="image">
                <img class="img4" src="../../img/mapas/nexterra.png" alt="">
            </div>
            </div>
        </div>

        </div>
</body>
</html>