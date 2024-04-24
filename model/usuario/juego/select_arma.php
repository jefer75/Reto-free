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


//condicional para mostrar armas y mapas segun el nivel del jugador en los select
if ($nivel <= 4) {
    $id_mapa = 1;
    $lvl_min=1;
} else if ($nivel >= 5 and $nivel <= 9) {
    $id_mapa = 2;
    $lvl_min=5;
} else if ($nivel >= 10 and $nivel <= 14) {
    $id_mapa = 3;
    $lvl_min=10;
} else if ($nivel >= 15 and $nivel <= 19) {
    $id_mapa = 4;
    $lvl_min=15;
} else if ($nivel >= 20 and $nivel  <= 24) {
    $id_mapa = 5;
    $lvl_min=20;
} 
    $lvl_max=$lvl_min+4;
    if ($nivel >= 25){
        $lvl_min=25;
        $lvl_max=100;
    }

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formreg")) {
    
    $num_jug = 1;
    $id_mundo = $_POST['id_mundo'];
    
    if ($id_mundo == "") {

        //evalua si estan los campos llenos
        echo '<script>alert ("Seleccione uno de los mapas");</script>';
        echo '<script>window.location="select_arma.php"</script>';

    } else { 
                
            //consulta si hay una sala que tenga  menos de 5 jugadores, con el mundo indicado
            $fila = $con->prepare("SELECT * FROM salas WHERE id_mundo = $id_mundo AND lvl_min <= $nivel AND lvl_max >= $nivel AND num_jug <=5");
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
            $actualizar_num_jug = $con->prepare("UPDATE salas SET num_jug=$num_jug WHERE id_sala = $id_sala");
            $actualizar_num_jug->execute();

            
        }

        //sino encuentra sala con ese mundo, ejecute
        else {
    
            //crea una sala con el mundo seleccionado por el usuario
            $fila = $con->prepare("INSERT INTO salas (lvl_min, lvl_max, num_jug, id_mundo) VALUES ( $lvl_min, $lvl_max,1, $id_mundo)");
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

                $insert_jug = $con->prepare("INSERT INTO `jugadores`(`username`, `id_sala`, `vida`, `daño_real`, `kills`, `id_estado`) VALUES ('$username',$id_sala, $vida, $daño_real, $kills, $estado)");
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
    header('location:index.php');
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

                    $control = $con->prepare("SELECT * from mundos WHERE id_mundo <= $id_mapa");
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