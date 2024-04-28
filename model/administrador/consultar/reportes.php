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
    <link rel="stylesheet" href="../../../css/mapas.css">
    <title>Mis partidas</title>
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

if (isset($_POST['regresar'])) {
    header('location:../inicio/index.php');
}

?>
    </header>
    
    <div class="container">

    <div class="tabla">
            <table>
                <tr>
                    <th>Id Partida</th>
                    <th>Sala</th>
                    <th>Nombre de usuario</th>
                    <th>Puntos</th>
                    <th>Kills</th>
                    <th>Mundo</th>
                </tr>
                <?php
    
                $sql= $con -> prepare ("SELECT * FROM partidas");
                $sql -> execute();
                $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);

                if ($fila){

                    foreach ($fila as $fila){

                        $id_partida=$fila['id_partida'];
                        $id_sala=$fila['id_sala'];
                        $username=$fila['username'];
                        $puntos=$fila['puntos'];
                        $kills=$fila['kills'];
                        $id_mundo=$fila['id_mundo'];
                                        
                    $sql= $con -> prepare ("SELECT * FROM salas WHERE id_sala='$id_sala'");
                    $sql -> execute();
                    $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);
                    foreach ($fila as $fila){

                        $id_mundo=$fila['id_mundo'];
                    }        

                        $sql= $con -> prepare ("SELECT * FROM mundos WHERE id_mundo='$id_mundo'");
                        $sql -> execute();
                        $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);
                        foreach ($fila as $fila){

                            $mundo=$fila['imagen'];
                        }         


?>
                <tr>
                    <td><?php echo $id_partida ?></td>
                    <td><?php echo $id_sala ?></td>
                    <td><?php echo $username ?></td>
                    <td><?php echo $puntos ?></td>
                    <td><?php echo $kills?></td>
                    <td><img src="<?php echo $mundo?>" width="100"></td>
                </tr>
                <?php
                }
            }
                ?>

            </table>
        </div>

    </div>

</body>
</html>