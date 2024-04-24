<?php
session_start();
require_once "../../db/connection.php";
// include("../../../controller/validarSesion.php");
$db = new Database();
$con = $db->conectar();

    //declaracion de variables de campos en la tabla

    if (isset($_POST['actualizar'])){

        $id_tipo_arma = $_POST['id_tipo_arma'];
        $nomb_arma = $_POST['nomb_arma'];
        $daño= $_POST['daño'];
        $cant_balas = $_POST['cant_balas'];                        
        $imagen = $_POST['imagen'];
        $rango = $_POST['id_rango'];
        
        if($id_tipo_arma == "" || $nomb_arma == "" || $daño == "" || $cant_balas == "" || $rango == ""){
            echo '<script> alert ("No modificaste ningun dato");</script>';
        }else {
    
            $insert= $con -> prepare ("UPDATE armas SET id_tipo_arma='$id_tipo_arma', nomb_arma='$nomb_arma', cant_balas=$cant_balas, dano='$daño' WHERE id_arma = '".$_GET['id']."'");
            $insert -> execute();
            echo '<script> alert ("Registro actualizado exitosamente");</script>';
            echo '<script> window.close(); </script>';
        }
        }
    else if (isset($_POST['eliminar'])){
            $insert= $con -> prepare ("DELETE FROM armas WHERE id_arma='".$_GET['id']."'");
            $insert -> execute();
            echo '<script> alert ("Registro eliminado exitosamente");</script>';
            echo '<script> window.close(); </script>';
    }  

                $query1 = $con->prepare("SELECT * FROM armas WHERE id_arma='".$_GET['id']."'");
                $query1->execute();
                $jugadores = $query1->fetchAll(PDO::FETCH_ASSOC);
                foreach ($jugadores as $fila) {
                    $id_arma = $fila['id_arma'];
                    $id_tipo_arma = $fila['id_tipo_arma'];
                    $nomb_arma = $fila['nomb_arma'];
                    $daño= $fila['dano'];
                    $cant_balas = $fila['cant_balas'];                        
                    $imagen = $fila['imagen'];
                    $rango = $fila['id_rango'];
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
                    <td>Tipo de arma</td>
                    <td>Nombre de arma</td>
                    <td>Daño</td>
                    <td>Cantidad de balas</td>
                    <td>Rango minimo</td>
                </tr>

                <tr>
                <td><select name="id_tipo_arma">
                    <option value ="<?php echo $id_tipo_arma?>"><?php echo $id_tipo_arma?></option>

                    <?php

                        $control = $con->prepare("SELECT * from tipo_armas");
                        $control->execute();
                        while ($fila = $control->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value=" . $fila['id_tipo_arma'] . ">"
                                . $fila['tipo_arma'] . "</option>";
                        }
                    ?>
                    </select></td>
                    <td><input type="varchar" name="nomb_arma" value="<?php echo $nomb_arma?>" ></td>                 
                    <td><input type="number" name="daño" value="<?php echo $daño ?>" ></td> 
                    <td><input type="number" name="cant_balas" value="<?php echo $cant_balas ?>" ></td> 
                    <td><input type="file" name="imagen" value="<?php echo $imagen ?>" ></td> 

                    <td><select name="id_rango">
                    <option value ="<?php echo $rango?>"><?php echo $rango?></option>

                    <?php

                        $control = $con->prepare("SELECT * from rangos");
                        $control->execute();
                        while ($fila = $control->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value=" . $fila['id_rango'] . ">"
                                . $fila['rango'] . "</option>";
                        }
                    ?>
                    </select></td>
                </tr>

                <tr>
                    <td><input type="submit" name="actualizar" value="Actualizar"></td>
                    <td><input type="submit" name="eliminar" value="Eliminar"></td>
                </tr>
            </form>
        </table>
    


</body>
</html>