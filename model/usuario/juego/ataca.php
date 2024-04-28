<?php
    session_start();
    require_once("../../../db/connection.php");
    // include("../../../controller/validarSesion.php");
    $db = new Database();
    $con = $db -> conectar();

    $username= $_SESSION['username'];

    $jug_atacado = $con -> prepare("SELECT * FROM jugadores WHERE username ='$username'");
    $jug_atacado -> execute ();
    $atacado = $jug_atacado -> fetchAll(PDO::FETCH_ASSOC);

    foreach ($atacado as $fila){
        $kills = $fila['kills'];
    }    
    

    ?>

<?php
    

    $jug_atacado = $con -> prepare("SELECT * FROM jugadores WHERE username ='".$_GET['id']."'");
    $jug_atacado -> execute ();
    $atacado = $jug_atacado -> fetchAll(PDO::FETCH_ASSOC);

    foreach ($atacado as $fila){
        $user_atacado = $fila ['username'];
        $vida = $fila ['vida'];
        $estado= $fila ['id_estado'];
    }    

    $query = $con->prepare("SELECT * FROM usuarios Where username='$username'");
    $query->execute();
    $resultados = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($resultados as $fila) {
        $nivel = $fila['nivel'];
        $puntos = $fila['puntos'];
        $rango = $fila['id_rango'];
    }

    $query = $con->prepare("SELECT * FROM jugadores Where username='$username'");
    $query->execute();
    $resultados = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($resultados as $fila) {
        $puntos= $fila['dano_real'];
    }
    
    
    
    if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formreg")) {

    $id_arma = $_POST['id_arma'];
    if ($id_arma=="")
      {
          echo '<script>alert ("Selecciona tu arma");</script>';
        }
        
        else {
            
            $con_daño = $con -> prepare("SELECT * FROM  armas WHERE id_arma = $id_arma");
            $con_daño -> execute ();
            $daños = $con_daño -> fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($daños as $fila){
                $daño = $fila ['dano']; 
            }


            $actualizado= $vida - $daño;
           
            
            if($actualizado <= 0){
    
                $actualizado = 0;
                $estado = 4;
                $kills=$kills+1;
                $puntos=$puntos+5;
            }            
    
            $actualizar= $con -> prepare ("UPDATE jugadores SET vida='$actualizado', id_estado='$estado' WHERE username = '$user_atacado'");
            $actualizar -> execute();

            $subir_puntos= $con -> prepare ("UPDATE jugadores SET dano_real=$puntos, kills='$kills' WHERE username = '$username'");
            $subir_puntos -> execute();


            if($puntos >= 250){
                $puntos_user= $con -> prepare ("UPDATE usuarios SET id_rango=$rango+1 WHERE username = '$username'");
                $puntos_user -> execute();
                }

            if($puntos >= 500){
            $puntos_user= $con -> prepare ("UPDATE usuarios SET puntos= 0, nivel=$nivel+1 WHERE username = '$username'");
            $puntos_user -> execute();
            }
            
            echo '<script> alert ("Ataque realizado con exito");</script>';
            echo '<script> window.close(); </script>';
        
        }
    
    }else if (isset($_POST['cancelar'])){
    
        echo '<script> alert ("Ataque cancelado");</script>';
        echo '<script> window.close(); </script>';   
    }  

    if ($estado == 3){
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

            <h4>Con que arma quieres atacar?</b>?</h4>
            
            <label for="id_arma"></label>
            <select name="id_arma" id="">
                
                <option value ="">Imagen nombre balas daño</option>
                <?php

                    if ($nivel == 1) {
                        $tipo_arma = 2;
                    } else if ($nivel == 2 ) {
                        $tipo_arma = 4;
                    }
                    $imagen = "IMAGEN";
                    $espacio1 = "   '";
                    $espacio2 = "'    (+";

                    $control = $con->prepare("SELECT * from armas WHERE id_arma <= $tipo_arma");
                    $control->execute();
                    while ($fila = $control->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value=" . $fila['id_arma'] . ">"
                            . $imagen . $espacio1 . $fila['nomb_arma'] ."   " .$fila['cant_balas']. $espacio2 .$fila['dano'] . ")</option>";
                    }
                ?>

            </select>

            
            <input type="submit" name="atacar" value="Atacar" class="registro">
            <input type="hidden" name="MM_insert" value="formreg">
        </form>

        <form method="POST">
            <input type="submit" name="cancelar" value="Cancelar">
        </form>
    </div>

</body>
</html>
<?php
}
else if ($estado=4){
     echo '<script> alert ("El usuario al que intentas atacar ya esta eliminado");</script>';
     echo '<script> window.close(); </script>';   
 }
?>