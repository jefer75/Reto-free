<?php
session_start();
require_once "../../db/connection.php";
// include("../../../controller/validarSesion.php");
$db = new Database();
$con = $db->conectar();

$username = $_SESSION['username'];

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formreg")) {

    $mundo = $_POST['id_mundo'];
    $arma = $_POST['id_arma'];
    $user = $username;
    $max_jug = 5;
    $daño_real = 0;
    $kills = 0;
    $vida = 100;
    $estado = 3;
    $num_jug = 0;

    if ($mundo == "" || $arma == "") {

        //evalua si estan los campos llenos
        echo '<script>alert ("Por favor llene todos los campos");</script>';
        echo '<script>window.location="select_arma.php"</script>';

    } else {

        //consulta si hay una sala que tenga  menos de 5 jugadores, con el mundo indicado
        $fila = $con->prepare("SELECT * FROM `salas` WHERE id_mundo = $mundo AND num_jug <= $max_jug");
        $fila->execute();
        $numero_jugadores = $fila->fetchAll(PDO::FETCH_ASSOC);

        //si encuentra una sala, ejecute....
        if ($fila){
            
            foreach ($numero_jugadores as $fila) {
            
                //declara las variables del registro que encontro
                $id_sala = $fila['id_sala'];
                $num_jug = $fila['num_jug'];
                
            }
    
            //Crea una sala en caso de no haber ninguna sala adecuada
            // $crear_sala -> prepare("INSERT INTO salas (max_jug ,num_jug ,id_mundo)VALUES ($max_jug ,$num_jug ,$mundo)");
            // $crear_sala -> execute();
        
        //busca
        
        //crea un registro con el numero de la sala, en la tabla jugadores
        $insert_arma = $con->prepare("INSERT INTO jugadores(username, id_sala, vida, id_arma, id_estado) VALUES('$username','$id_sala', '$vida' , '$arma', '$estado')");
        $insert_arma->execute();

        //agrega 1 al numero de jugadores en la sala seleccionada de la tabla salas
        $num_jug = $num_jug + 1;

        //actualiza el numero de jugadores
        $actualizar_num_jug = $con->prepare("UPDATE salas SET num_jug=$num_jug WHERE id_sala = $id_sala");
        $actualizar_num_jug->execute();

        echo '<script> alert("INGRESO EXITOSO");</script>';
        echo '<script>window.location="juego.php"</script>';
        }
        //sino encuentra sala, ejecute
        else {


        }
    }

}

//consulta el nivel del usuario
$query = $con->prepare("SELECT * FROM usuarios Where username='$username'");
$query->execute();
$resultados = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($resultados as $fila) {
    //declara en la variable nivel, el nivel del jugador
    $nivel = $fila['nivel'];
}

//condicional para mostrar armas y mapas segun el nivel del jugador en los select
if ($nivel <= 4) {
    $id_arma = 3;
    $id_mapa = 1;
} else if ($nivel >= 5 and $nivel <= 9) {
    $id_arma = 6;
    $id_mapa = 2;
} else if ($nivel >= 10 and $nivel <= 14) {
    $id_arma = 9;
    $id_mapa = 3;
} else if ($nivel >= 15 and $nivel <= 19) {
    $id_arma = 12;
    $id_mapa = 4;
} else if ($nivel >= 20 and $nivel <= 24) {
    $id_arma = 15;
    $id_mapa = 5;
} else if ($nivel >= 25 and $nivel <= 29) {
    $tipo_arma = 18;
} else if ($nivel > 29) {
    $tipo_arma = 21;
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

        <label for="id_arma"></label>
        <select name="id_arma">
            <option value ="">Arma   (Daño)</option>

            <?php

                $control = $con->prepare("SELECT * from armas WHERE id_arma <= $id_arma");
                $control->execute();
                while ($fila = $control->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value=" . $fila['id_arma'] . ">"
                . $imagen . $espacio1 . $fila['nomb_arma'] . $espacio2 . $fila['daño'] . ")</option>";
                }
            ?>
        </select>

        <input type="submit" name="validar" value="Juega">
        <input type="hidden" name="MM_insert" value="formreg">

    </form>

    </div>
</body>
</html>