<?php
session_start();
require_once "../../../db/connection.php";
// include("../../../controller/validarSesion.php");
$db = new Database();
$con = $db->conectar();

$username = $_SESSION['username'];

//consulta el nivel del usuario
        $query = $con->prepare("SELECT * FROM usuarios Where username='$username'");
        $query->execute();
        $resultados = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultados as $fila) {
            $nivel = $fila['nivel'];
        }

        switch($nivel){
            case 1:
                $mapas=2;
                break;
            case 2:
                $mapas=4;
                break;
        }

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formreg")) {
    
    $id_mundo = $_POST['id_mundo'];
    
    if ($id_mundo == "") {

        //evalua si estan los campos llenos
        echo '<script>alert ("Seleccione uno de los mapas");</script>';
        echo '<script>window.location="select_arma.php"</script>';

    } else { 
                
            //consulta si hay una sala que tenga  menos de 5 jugadores, con el mundo indicado
            $fila = $con->prepare("SELECT * FROM salas WHERE id_mundo = $id_mundo AND nivel = $nivel AND num_jug <=5");
            $fila->execute();
            $numero_jugadores = $fila->fetchAll(PDO::FETCH_ASSOC);
                
                //si encuentra una sala, ejecute....
            if ($numero_jugadores){
            
            foreach ($numero_jugadores as $fila) {
            
                //declara las variables del registro que encontro
                $id_sala = $fila['id_sala'];
                $num_jug = $fila['num_jug'];
            }
        
            //agrega 1 al numero de jugadores en la sala seleccionada de la tabla salas

            //actualiza el numero de jugadores de la sala encontrada
            $actualizar_num_jug = $con->prepare("UPDATE salas SET num_jug=$num_jug+1 WHERE id_sala = $id_sala");
            $actualizar_num_jug->execute();

            
        }

        //sino encuentra sala con ese mundo, ejecute
        else {
    
            //crea una sala con el mundo seleccionado por el usuario
            $fila = $con->prepare("INSERT INTO salas (nivel, num_jug, id_mundo) VALUES ( $nivel, 1, $id_mundo)");
            $fila->execute();
        }
            //consulta el identificador de la sala que acabamos de crear
            $con_id = $con->prepare("SELECT * FROM salas WHERE id_mundo = $id_mundo AND num_jug <=5");
            $con_id->execute();
            $datos = $con_id->fetchAll(PDO::FETCH_ASSOC);
                        
            foreach ($datos as $fila) {
                    
                //declara las variables del registro que encontro
                $id_sala = $fila['id_sala'];
            } 

                $vida = 100;
                $daño_real = 0;
                $kills = 0;
                $estado = 3;

                $insert_jug = $con->prepare("INSERT INTO `jugadores`(`username`, `id_sala`, `vida`, `dano_real`, `kills`, `id_estado`) VALUES ('$username',$id_sala, $vida, $daño_real, $kills, $estado)");
                $insert_jug->execute();

        echo '<script> alert("INGRESO EXITOSO");</script>';
        echo '<script>window.location="juego.php"</script>';
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elige tu arma</title>
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

<form method="post" name="formreg" id="formreg" class="signup-form"  autocomplete="off">

        <label for="id_mundo"></label>
        <select name="id_mundo">
                <option value ="">Seleccione el mapa</option>

                <?php

                

                    $imagen = "IMAGEN";
                    $espacio1 = ".   ";
                    $espacio2 = ".    (+";

                    $control = $con->prepare("SELECT * from mundos WHERE id_mundo <= $mapas");
                    $control->execute();
                    while ($fila = $control->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value=" . $fila['id_mundo'] . ">"
                            . $imagen . $espacio1 . $fila['nomb_mundo'] . "</option>";
                    }
                ?>
        </select>

        <input type="submit" name="validar" value="Juega">
        <input type="hidden" name="MM_insert" value="formreg">

    </form>

    </div>
</body>
</html>