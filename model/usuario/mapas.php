<?php
    session_start();
    require_once("../../db/connection.php");
    // include("../../../controller/validarSesion.php");
    $db = new Database();
    $con = $db -> conectar();

    $username= $_SESSION['username'];

        $query = $con -> prepare("SELECT * FROM usuarios Where username='$username'");
            $query -> execute ();
            $resultados = $query -> fetchAll(PDO::FETCH_ASSOC);

            foreach ($resultados as $fila){

                $puntos=$fila['puntos'];
                $nivel=$fila['nivel'];

            }
    
            if ($nivel <= 5){

                $query1 = $con -> prepare("SELECT * FROM mundos where id_mundo = 1");
                $query1 -> execute ();
                $mundo = $query1 -> fetchAll(PDO::FETCH_ASSOC);
        
            }
            else if ($nivel >= 5 AND $nivel < 10){
                $query1 = $con -> prepare("SELECT * FROM mundos where id_mundo <= 2");
                $query1 -> execute ();
                $mundo = $query1 -> fetchAll(PDO::FETCH_ASSOC);
            }
            else if ($nivel >= 10 AND $nivel < 15){
                $query1 = $con -> prepare("SELECT * FROM mundos where id_mundo <= 3");
                $query1 -> execute ();
                $mundo = $query1 -> fetchAll(PDO::FETCH_ASSOC);
            }
            else if ($nivel >= 15 AND $nivel < 20){
                $query1 = $con -> prepare("SELECT * FROM mundos where id_mundo <= 4");
                $query1 -> execute ();
                $mundo = $query1 -> fetchAll(PDO::FETCH_ASSOC);
            }
            else if ($nivel >= 20){
                $query1 = $con -> prepare("SELECT * FROM mundos where id_mundo <= 5");
                $query1 -> execute ();
                $mundo = $query1 -> fetchAll(PDO::FETCH_ASSOC);
            }



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Mapas</title>
</head>
<body>
    
<header>
        <form action="" method="POST">
        
        <td>
        
            <input type="submit" value="Regresar" name="regresar" id="regresar"> 
        </td>
        
        </tr>
        </form>
        <?php 
        
        if(isset($_POST['regresar']))
        {        
            header('location:index.php');
        }
        
        ?>
    </header>
    
    <div class="container">

    <h1 class="title">Mapas</h1>
        <table>
            <tr> 
                <td>Nombre del mapa</td>
                <td>Mapa</td>
            </tr>
            
            <?php

                  foreach ($mundo as $fila){
            ?>
            <tr>
                <td><?php echo $fila['nomb_mundo']?></td>
                <td><?php echo $fila['mundo']?></td>              
            </tr>
            <?php
                  }
            ?>
         
        </table>

    </div>

</body>
</html>