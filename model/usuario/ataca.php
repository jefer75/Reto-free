<?php
    session_start();
    require_once("../../db/connection.php");
    // include("../../../controller/validarSesion.php");
    $db = new Database();
    $con = $db -> conectar();

    $username= $_SESSION['username'];

    $mostrar_arma = $con -> prepare("SELECT * FROM jugadores WHERE username ='".$_GET['id']."'");
    $mostrar_arma -> execute ();
    $armas = $mostrar_arma -> fetchAll(PDO::FETCH_ASSOC);

    foreach ($armas as $fila){
        $user_atacado = $fila ['username'];
        $vida = $fila ['vida'];

    }

    if (isset($_POST['actualizar'])){

        $con_arma = $con -> prepare("SELECT * FROM jugadores WHERE username ='$username'");
        $con_arma -> execute ();
        $arma = $con_arma -> fetchAll(PDO::FETCH_ASSOC);
    
        foreach ($arma as $fila){
            $id_arma = $fila ['id_arma'];
    
            $con_daño = $con -> prepare("SELECT * FROM armas WHERE id_arma =$id_arma");
            $con_daño -> execute ();
            $daños = $con_daño -> fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($daños as $fila){
                $daño = $fila ['daño'];
            }
        }

        $actualizado= $vida - $daño;

        $actualizar= $con -> prepare ("UPDATE jugadores SET vida='$actualizado' WHERE username = '$user_atacado'");
        $actualizar -> execute();

        echo '<script> alert ("Ataque realizado con exito");</script>';
        echo '<script> window.close(); </script>';   
    }
    if (isset($_POST['cancelar'])){
    
        echo '<script> alert ("Ataque cancelado");</script>';
        echo '<script> window.close(); </script>';   
        echo $actualizado;
    }  
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script>
        function centrar() {
            iz=(screen.width-document.body.clientWidth) / 2;
            de=(screen.height-document.body.clientHeight) / 3;
            moveTo(iz,de);
        }
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atacar</title>
</head>
<body>
    
    <div class="">

        <form action="" method="POST">

            <p><?php echo $username ?> estás a punto de atacar a <b><?php echo $user_atacado ?></b>?</p>
            <h3>Estas seguro?</h3>

            <input type="submit" name="cancelar" value="Cancelar">
            <input type="submit" name="actualizar" value="Atacar">
        </form>

    </div>

</body>
</html>