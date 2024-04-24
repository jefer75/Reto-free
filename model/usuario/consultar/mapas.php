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
    
            if ($nivel < 5){
                $id_mundo=1;        
            }
            else if ($nivel >= 5 AND $nivel <= 9){
                $id_mundo=2;                
            }
            else if ($nivel >= 10 AND $nivel <= 14){
                $id_mundo=3;               
            }
            else if ($nivel >= 15 AND $nivel <= 19){
                $id_mundo=4;               
            }
            else if ($nivel >= 20){
                $id_mundo=5;                
            }

            

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/mapas.css">
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
            <thead> 
                <th>Nombre del mapa</th>
                <th>Mapa</th>
                <th>Estado</th>
            </thead>
            
            <?php

                $query1 = $con->prepare("SELECT * FROM mundos");
                $query1->execute();
                $arma = $query1->fetchAll(PDO::FETCH_ASSOC);
                foreach ($arma as $fila) {
                $nombre = $fila['nomb_mundo'];
                $mundo = $fila['mundo'];
                $id_estado = $fila['id_estado'];

                $act_disponible = $con->prepare("UPDATE mundos SET id_estado='5' WHERE id_mundo <= $id_mundo");
                $act_disponible->execute();

                $con_estado = $con->prepare("SELECT * FROM estados where id_estado <= $id_estado");
                $con_estado->execute();
                $estados = $con_estado->fetchAll(PDO::FETCH_ASSOC);
                foreach ($estados as $fila) {
                    $estado= $fila['estado'];
                }
            ?>
            <tr>
                <td><?php echo $nombre?></td>
                <td><?php echo $mundo?></td>
                <td 
                <?php
                    if ($id_estado==5){
                        
                    echo"class='estado_'";
                    
                    }
                    else if($id_estado==6){
                        echo"class='estado_red'";
                    }
                ?>
                ><?php echo $estado?></td>
            </tr>
            <?php
                  }
            ?>
         
        </table>

    </div>
</body>
</html>