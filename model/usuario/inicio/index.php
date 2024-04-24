<?php
session_start();
require_once "../../../db/connection.php";
// include("../../../controller/validarSesion.php");
$db = new Database();
$con = $db->conectar();

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="../../../css/index_usu.css">
</head>
<body>

        <?php
if (isset($_POST['cerrar_sesion'])) {
    session_destroy();
    header('location:../../../index.html');
}

?>

    <div class="menu-container">
        <div class="menu">
            <a href="../consultar/reportes.php" class="btn">Resultados</a>
            <a href="../consultar/armas.php" class="btn">Armas</a>
            <a href="../consultar/mapas.php" class="btn">mapas</a>
            <a href="../juego/seleccion.php" class="btn_jugar">Jugar</a>
        </div>
    </div>

    <div class="container">
    <div class="sidebar">
    <form action="" method="POST">

        <td>


            <input type="submit" value="Cerrar Sesion" name="cerrar_sesion" id="cerrar_sesion">
        </td>

        </tr>
        </form>


        <?php

$query = $con->prepare("SELECT * FROM usuarios Where username='$username'");
$query->execute();
$resultados = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($resultados as $fila) {

    $id_avatar = $fila['id_avatar'];
    $username = $fila['username'];
    $nivel = $fila['nivel'];
    $puntos = $fila['puntos'];
    $id_rango = $fila['id_rango'];

    $query2 = $con->prepare("SELECT * FROM rangos where id_rango =$id_rango");
    $query2->execute();
    $rango = $query2->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rango as $fila) {

        $rango = $fila['imagen'];
    }


$query1 = $con->prepare("SELECT * FROM avatares where id_avatar =$id_avatar");
$query1->execute();
$avatar = $query1->fetchAll(PDO::FETCH_ASSOC);
foreach ($avatar as $fila) {

    ?>


            <img src="<?php echo $avatar = $fila['imagen'];
} ?>" width="100" height="100" alt="">
            <div class="texto">
            <h4><?php echo $username; ?></h4>
            <p>Level <?php echo $nivel; ?></p>
            <p>Puntos <?php echo $puntos; ?></p>
            <img src="<?php echo $rango; }?>" width="70" height="70" alt="">
            </div>
        </div>
    </div>

        <div class="carrusel">
            <div class="image-box">
            <div class="image">
                <img class="img1" src="../../../img/mapas/bermuda.jpg" alt="">
            </div>
            <div class="image">
                <img class="img2" src="../../../img/mapas/alpes.jpg" alt="">
            </div>
            <div class="image">
                <img class="img3" src="../../../img/mapas/purgatorio.jpg" alt="">
            </div>
            <div class="image">
                <img class="img4" src="../../../img/mapas/kalahari.jpg" alt="">
            </div>
            <div class="image">
                <img class="img4" src="../../../img/mapas/nexterra.png" alt="">
            </div>
            </div>
        </div>

        </div>

        <script>

            document.getElementById('menu-btn').addEventListener('click', function() {
            var menu = document.querySelector('.menu');
            if (menu.style.display === 'none' || menu.style.display === '') {
            menu.style.display = 'block';
            } else {
            menu.style.display = 'none';
            }
        });


        </script>
</body>
</html>