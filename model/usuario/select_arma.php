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
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escoge</title>
</head>
<body>
    
<div class="container">

<form method="post" name="formreg" id="formreg" class="signup-form"  autocomplete="off"> 

        <label for="mundo"></label>
        <select name="mundo">
                <option value ="">Seleccione el mapa</option>
                
                <?php
                    $control = $con -> prepare ("SELECT * from mundos");
                    $control -> execute();
                while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
                {
                    echo "<option value=" . $fila['id_mundo'] . ">"
                    . $fila['mundo'] . "</option>";
                } 
                ?>
        </select>
        <label for="arma"></label>
        <select name="arma">
                <option value ="">Seleccione el arma</option>
                
                <?php
                    $control = $con -> prepare ("SELECT * from armas");
                    $control -> execute();
                while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
                {
                    echo "<option value=" . $fila['id_arma'] . ">"
                    . $fila['arma'] . "</option>";
                } 
                ?>
        </select>

        <input type="submit" name="validar" value="Juega">
        <input type="hidden" name="MM_insert" value="formreg">
    </form>

</div>

</body>
</html>