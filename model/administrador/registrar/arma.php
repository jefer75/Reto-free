<?php
    session_start();
    require_once("../../../db/connection.php");
    // include("../../../controller/validarSesion.php");
    $db = new Database();
    $con = $db -> conectar();


   if ((isset($_POST["MM_insert"]))&&($_POST["MM_insert"]=="formreg"))
   {
    $tipo_arma= $_POST['tipo_arma'];
    $nomb_arma= $_POST['nomb_arma'];
    $daño= $_POST['daño'];
    $cant_balas= $_POST['cant_balas'];

    $nombre = $_FILES['image']['name'];
    $tipo = $_FILES['image']['type'];
    $tamanio = $_FILES['image']['size'];
    $ruta = $_FILES['image']['tmp_name'];
    $destino = "../../../img/armas/" . $nombre;

    $puntos= $_POST['puntos'];
    
     $sql= $con -> prepare ("SELECT * FROM armas WHERE nomb_arma='$nomb_arma'");
     $sql -> execute();
     $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);

     if ($fila){
        echo '<script>alert ("Esta arma ya esta en uso");</script>';
        echo '<script>window.location="arma.php"</script>';
     }

     else if ($tipo_arma=="" || $nomb_arma=="" || $daño=="" || $cant_balas=="" || $destino=="" ||$puntos=="" )
      {
         echo '<script>alert ("Por favor llene todos los campos");</script>';
         echo '<script>window.location="arma.php"</script>';
      }
      
      else {

        $insertSQL = $con->prepare("INSERT INTO armas(id_tipo_arma, nomb_arma, dano, cant_balas, imagen, puntos) VALUES('$tipo_arma', '$nomb_arma', $daño, $cant_balas, '$destino','$puntos')");
        $insertSQL -> execute();
        echo '<script> alert("REGISTRO EXITOSO");</script>';
        echo '<script>window.location="../consultar/armas.php"</script>';
     }  
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/registro.css">
    <title>Crear arma</title>
</head>
<body>
<header>
        <form action="" method="POST">
        
        <td>
        
            <input type="submit" value="Regresar" name="regresar" class="regresar"> 
        </td>
        
        </tr>
        </form>
        <?php 
        
        
if (isset($_POST['regresar'])) {
    header('location:../consultar/armas.php');
}
        
        ?>
    </header>
    <div class="box">
        <span class="borderLine"></span>

        <form method="post" name="formreg" id="formreg" class="signup-form"  autocomplete="off"> 
            <h2>Crear arma</h2>
        
            <div class="inputBox">
            <span>Seleccione el tipo de arma</span>
                <select name="tipo_arma">
                        <option value ="">Seleccione</option>
                        
                        <?php
                            $control = $con -> prepare ("SELECT * from tipo_armas");
                            $control -> execute();
                        while ($fila = $control->fetch(PDO::FETCH_ASSOC)) 
                        {
                            echo "<option value=" . $fila['id_tipo_arma'] . ">"
                            . $fila['tipo_arma'] . "</option>";
                        } 
                        ?>
                </select>
            </div>

            <div class="inputBox">
            <input type="varchar" name="nomb_arma" placeholder="Nombre de arma">
            <span>Digite el nombre del arma</span>
            <i></i>
            </div>
            
            <div class="inputBox">
                <input type="number" name="daño" placeholder="Digite el daño">
                <span>Digite el daño</span>
                <i></i>
            </div>

            <div class="inputBox">
                <input type="number" name="cant_balas" placeholder="Digite la cantidad de balas">
                <span>Digite la cantidad de balas</span>
                <i></i>
            </div>
            
            <div class="inputBox">
                <input type="file" accept="image/*"  name="image" required>
                <span>Adjute la imagen</span>
                <i></i>
            </div>

            <div class="inputBox">
                <input type="number" name="puntos" placeholder="Digite la cantidad de puntos">
                <span>Digite los puntos que otorga</span>
                <i></i>
            </div>

            <input type="submit" name="validar" value="Registro" class="registro">
            <input type="hidden" name="MM_insert" value="formreg">

            <div class="links_container">
            <a href="login.php" class="links">Iniciar Sesion</a>
        </div>
        </form>
    </div>
</body>
</html>