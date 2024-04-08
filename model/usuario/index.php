<?php
    session_start();
    require_once("../../db/connection.php");
    // include("../../../controller/validarSesion.php");
    $db = new Database();
    $con = $db -> conectar();

    $sql= $con -> prepare ("SELECT * FROM usuarios WHERE username='$username'");
     $sql -> execute();
     $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
</head>
<body>
    <div class="container">

        <h2></h2>
        



    </div>
</body>
</html>