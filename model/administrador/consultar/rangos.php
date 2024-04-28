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
    <link rel="stylesheet" href="../../../css/rangos.css">
    <title>Rangos</title>
</head>
<body>
    
<header>
        <form action="" method="POST">
        
        <td>
        
            <input type="submit" value="Regresar" name="regresar" id="regresar"> 
        </td>
        <td>
            <input type="submit" value="Registrar" name="registrar">
        </td>
        
        </tr>
        </form>
        <?php 
        
        if(isset($_POST['regresar']))
        {        
            header('location:../inicio/index.php');
        } else if (isset($_POST['registrar'])){
            header('location:../registrar/rangos.php');
        }
        
        ?>
    </header>
    
    <div class="container">

    <h1 class="title">Rangos</h1>
        <table>
            <thead> 
                <th>Nombre de rango</th>
                <th>Imagen</th>
            </thead>
            
            <?php

                $query1 = $con->prepare("SELECT * FROM rangos");
                $query1->execute();
                $arma = $query1->fetchAll(PDO::FETCH_ASSOC);
                foreach ($arma as $fila) {
                $nombre = $fila['nomb_rango'];
            ?>
            <tr>
                <td><?php echo $nombre?></td>
                <td><img class="imagenes" src="<?php echo $fila['imagen'];?>" width="100" height="100" alt="Imagen"></td>
                
            </tr>
            <?php
                  }
            ?>
         
        </table>

    </div>
</body>
</html>