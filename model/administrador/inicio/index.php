<?php
    session_start();
    require_once("../../../db/connection.php");
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
    <link rel="stylesheet" href="../../../css/index_admin.css">
</head>
<body>
<!--  -->
        <?php 
            if (isset($_POST['cerrar_sesion']))
            {
                session_destroy();
                header('location:../../../index.html');
            }
        ?> 

    <div class="container">
        <div class="sidebar">
            <form action="" method="POST">
                <td class="cerrar_sesion">
                    <input type="submit" value="Cerrar Sesion" name="cerrar_sesion" class="cerrar_sesion"> 
                </td>
            </form>
        
            <?php

                $query = $con -> prepare("SELECT * FROM usuarios Where username='$username'");
                $query -> execute ();
                $resultados = $query -> fetchAll(PDO::FETCH_ASSOC);

                foreach ($resultados as $fila){
                    
                $id_avatar=$fila['id_avatar'];
                $username=$fila['username'];
                
                    $query1 = $con -> prepare("SELECT * FROM avatares where id_avatar =$id_avatar");
                    $query1 -> execute ();
                    $avatar = $query1 -> fetchAll(PDO::FETCH_ASSOC);
                    foreach ($avatar as $fila){

                    $avatar=$fila['imagen'];
                    }
                }
            ?> 

            <img src="<?php echo $avatar; ?>" width="110" height="110" alt="">
            <div class="texto">
                <h4><?php echo $username; ?></h4> 
            </div>
            <div class="menu">
                <a href="../consultar/usuarios.php"><button class="btn" name="usuarios">Jugadores</button></a>
                <a href="../consultar/reportes.php"><button class="btn" name="reportes">Reportes</button></a>
                <a href="../consultar/armas.php"><button class="btn" name="armas">Armas</button></a>
                <a href="../consultar/mapas.php"><button class="btn" name="mapas">Mapas</button></a>
                <a href="../consultar/avatares.php"><button class="btn" name="armas">Avatares</button></a>
                <a href="../consultar/rangos.php"><button class="btn" name="rangos">Rangos</button></a>
            </div>

        </div>
    </div>
</body>
</html>