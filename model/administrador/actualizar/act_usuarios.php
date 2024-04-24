<?php
session_start();
require_once "../../db/connection.php";
// include("../../../controller/validarSesion.php");
$db = new Database();
$con = $db->conectar();

    //declaracion de variables de campos en la tabla

    if (isset($_POST['actualizar'])){

        $nombre= $_POST['username'];
        $nivel= $_POST['nivel'];
        $puntos= $_POST['puntos'];
        $id_rango= $_POST['rango'];
        $estado= $_POST['id_estado'];
        
        if($estado == ""){
            echo '<script> alert ("No modificaste ningun dato");</script>';
        }else {
    
            $insert= $con -> prepare ("UPDATE usuarios SET username='$nombre', nivel=$nivel, puntos=$puntos, id_rango=$id_rango id_estado='$estado' WHERE username = '".$_GET['id']."'");
            $insert -> execute();
            echo '<script> alert ("Registro actualizado exitosamente");</script>';
            echo '<script> window.close(); </script>';
        }
        }
    else if (isset($_POST['eliminar'])){
            $insert= $con -> prepare ("DELETE FROM usuarios WHERE username='".$_GET['id']."'");
            $insert -> execute();
            echo '<script> alert ("Registro eliminado exitosamente");</script>';
            echo '<script> window.close(); </script>';
    }  

                $query1 = $con->prepare("SELECT * FROM usuarios WHERE username='".$_GET['id']."'");
                $query1->execute();
                $jugadores = $query1->fetchAll(PDO::FETCH_ASSOC);
                foreach ($jugadores as $fila) {
                    $nombre = $fila['username'];
                    $nivel = $fila['nivel'];
                    $puntos = $fila['puntos'];
                    $id_rango = $fila['id_rango'];
                    $id_estado = $fila['id_estado'];
                }
?>

<!DOCTYPE html>
<html lang="en">
    <script>
        function centrar() {
            iz=(screen.width-document.body.clientWidth) / 2;
            de=(screen.height-document.body.clientHeight) / 3;
            moveTo(iz,de);
        }
    </script>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/6375/6375816.png">
    <link rel="stylesheet" href="../../../css/tablaedi.css">
    <title></title>
</head>
<body onload="centrar();">
    
        <table class="center">
            <form autocomplete="off" name="form_actualizar" method="POST">
                <tr>
                    <td>Nombre de usuario</td>
                    <td>Nivel</td>
                    <td>Puntos</td>
                    <td>Rango</td>
                    <td>Estado</td>
                </tr>

                <tr>
                    <td><input type="varchar" name="username" value="<?php echo $nombre?>" ></td>                 
                    <td><input type="number" name="nivel" value="<?php echo $nivel ?>" ></td> 
                    <td><input type="number" name="puntos" value="<?php echo $puntos ?>" ></td> 
                    <td><select name="id_rango">
                    <option value ="<?php echo $id_rango?>"><?php echo $id_rango?></option>

                    <?php

                        $control = $con->prepare("SELECT * from rangos");
                        $control->execute();
                        while ($fila = $control->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value=" . $fila['id_rango'] . ">"
                                . $fila['rango'] . "</option>";
                        }
                    ?>
                    </select></td>
                    
                    <td><select name="id_estado">
                    <option value ="<?php echo $id_estado?>"><?php echo $id_estado?></option>

                    <?php

                        $control = $con->prepare("SELECT * from estados WHERE id_estado <= 2");
                        $control->execute();
                        while ($fila = $control->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value=" . $fila['id_estado'] . ">"
                                . $fila['estado'] . "</option>";
                        }
                    ?>
                    </select></td>
                    <td></td>
                </tr>

                <tr>
                    <td><input type="submit" name="actualizar" value="Actualizar"></td>
                    <td><input type="submit" name="eliminar" value="Eliminar"></td>
                </tr>
            </form>
        </table>
    


</body>
</html>