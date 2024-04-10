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

                $query1 = $con -> prepare("SELECT * FROM armas where id_arma <= 2");
                $query1 -> execute ();
                $arma = $query1 -> fetchAll(PDO::FETCH_ASSOC);
        
            }
            else if ($nivel >= 5 AND $nivel <= 10){
                $query1 = $con -> prepare("SELECT * FROM armas where id_arma <= 4");
                $query1 -> execute ();
                $arma = $query1 -> fetchAll(PDO::FETCH_ASSOC);
            }
            else if ($nivel >= 10 AND $nivel <= 15){
                $query1 = $con -> prepare("SELECT * FROM armas where id_arma <= 6");
                $query1 -> execute ();
                $arma = $query1 -> fetchAll(PDO::FETCH_ASSOC);
            }
            else if ($nivel >= 15 AND $nivel <= 20){
                $query1 = $con -> prepare("SELECT * FROM armas where id_arma <= 8");
                $query1 -> execute ();
                $arma = $query1 -> fetchAll(PDO::FETCH_ASSOC);
            }
            else if ($nivel >= 20 AND $nivel <= 25){
                $query1 = $con -> prepare("SELECT * FROM armas where id_arma <= 10");
                $query1 -> execute ();
                $arma = $query1 -> fetchAll(PDO::FETCH_ASSOC);
            }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Armas</title>
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

        <div class="tabla">
            <table>
                <tr>
                    <th>Nombre de arma</th>
                    <th>Daño</th>
                    <th>Arma</th>
                </tr>
                
                <?php

                  foreach ($arma as $fila){
                ?>

                <tr>
                    <td><?php echo $fila['nomb_arma']?></td>
                    <td><?php echo $fila['daño']?></td>
                    <td><?php echo $fila['arma']?></td>
                </tr>
                <?php
                  }
                ?>

            </table>
        </div>

    </div>

</body>
</html>