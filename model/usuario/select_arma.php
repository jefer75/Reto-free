<?php
    session_start();
    require_once("../../db/connection.php");
    // include("../../../controller/validarSesion.php");
    $db = new Database();
    $con = $db -> conectar();

    $username= $_SESSION['username'];
    

    if ((isset($_POST["MM_insert"]))&&($_POST["MM_insert"]=="formreg"))
   {        
        
        $mundo= $_POST['mundo'];
        $arma= $_POST['arma'];
        $max_jug= 5;
        $daño_real= 0;
        $kills= 0;
        $vida=100;
        $estado=3;

     if ($mundo=="" || $arma=="")
      {
         echo '<script>alert ("Por favor llene todos los campos");</script>';
         echo '<script>window.location="select_arma.php"</script>';

      }
      
      else{
   
                $query1 = $con -> prepare("SELECT * FROM `salas` WHERE id_mundo = $mundo AND num_jug <= $max_jug");
                $query1 -> execute ();
                $numero_jugadores = $query1 -> fetchAll(PDO::FETCH_ASSOC);
                
                foreach ($numero_jugadores as $fila){

                    $id_sala=$fila['id_sala'];
                    $num_jug=$fila['num_jug'];   
                }
    
                $insert_arma = $con->prepare("INSERT INTO jugadores(id_sala, username, vida, id_arma, id_estado) VALUES($id_sala, '$username', $vida , $arma, $estado)");
                $insert_arma -> execute();


                $num_jug =$num_jug + 1;


                $actualizar_num_jug = $con->prepare("UPDATE salas SET num_jug=$num_jug WHERE id_sala = $id_sala");
                $actualizar_num_jug -> execute();
    
                echo '<script> alert("INGRESO EXITOSO");</script>';
                echo '<script>window.location="juego.php"</script>';
            
               
      }

    } 
    $query = $con -> prepare("SELECT * FROM usuarios Where username='$username'");
    $query -> execute ();
    $resultados = $query -> fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($resultados as $fila){
        $nivel=$fila['nivel'];
    }
    
    if ($nivel <= 4){
        $id_arma=2;
        $id_mapa=1;
    }
    else if ($nivel >= 5 AND $nivel <= 9){
        $id_arma=4;
        $id_mapa=2;
    }
    else if ($nivel >= 10 AND $nivel <= 14){
        $id_arma=6;
        $id_mapa=3;
    }
    else if ($nivel >= 15 AND $nivel <= 19){
        $id_arma=8;
        $id_mapa=4;
    }
    else if ($nivel >= 20 AND $nivel  <= 24){
        $id_arma=10;
        $id_mapa=5;
    }
    else if ($nivel >= 25 ){
        $id_arma=12;
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
        
        if(isset($_POST['regresar']))
        {        
            header('location:index.php');
        }
        
        ?>
    </header>

<div class="container">

<form method="post" name="formreg" id="formreg" class="signup-form"  autocomplete="off"> 

        <label for="mundo"></label>
        <select name="mundo">
                <option value ="">Seleccione el mapa</option>
                
                <?php              
                    $imagen="IMAGEN";
                    $espacio1=".   ";
                    $espacio2=".    (+";

                    $control = $con -> prepare ("SELECT * from mundos WHERE id_mundo <= $id_mapa");
                    $control -> execute();
                while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
                {
                    echo "<option value=" . $fila['id_mundo'] . ">"
                    .$imagen .$espacio1 . $fila['nomb_mundo'] . "</option>";
                } 
                ?>
        </select>
        
        <label for="arma"></label>
        <select name="arma">
                <option value ="">Seleccione el arma</option>
                
                <?php
                

                $control = $con -> prepare ("SELECT * from armas WHERE id_arma <= $id_arma");
                $control -> execute();   
                while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
                {
                    echo "<option value=" . $fila['id_arma'] . ">"
                    . $imagen .$espacio1 .$fila['nomb_arma'] .$espacio2 .$fila['cant_balas'] .")</option>";
                } 
                ?>
        </select>

        <input type="submit" name="validar" value="Juega">
        <input type="hidden" name="MM_insert" value="formreg">

    </form>

    </div>
</body>
</html>