<?php
    session_start();
    require_once("../../../db/connection.php");
    // include("../../../controller/validarSesion.php");
    $db = new Database();
    $con = $db -> conectar();


   if (isset($_POST["MM_insert"])&&($_POST["MM_insert"]=="formreg"))
   {
    $nomb_rango= $_POST['nomb_rango'];
    $lvl_min= $_POST['lvl_min'];
    $lvl_max= $_POST['lvl_max'];
    $nombre = $_FILES['image']['name'];
    $tipo = $_FILES['image']['type'];
    $tamanio = $_FILES['image']['size'];
    $ruta = $_FILES['image']['tmp_name'];
    $destino = "../../../img/rangos/" . $nombre;
    
     $sql= $con -> prepare ("SELECT * FROM rangos WHERE nomb_rango='$nomb_rango'");
     $sql -> execute();
     $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);

     if ($fila){
        echo '<script>alert ("Esta arma ya esta en uso");</script>';
        echo '<script>window.location="rangos.php"</script>';
     }

     else if ($nomb_rango=="" || $lvl_min=="" || $lvl_max=="")
      {
         echo '<script>alert ("Por favor llene todos los campos");</script>';
         echo '<script>window.location="rangos.php"</script>';
      }
      
      else {

        $insertSQL = $con->prepare("INSERT INTO rangos(nomb_rango, lvl_min, lvl_max, imagen) VALUES('$nomb_rango', $lvl_min, $lvl_max, '$destino')");
        $insertSQL -> execute();
        echo '<script> alert("REGISTRO EXITOSO");</script>';
        echo '<script>window.location="../consultar/rangos.php"</script>';
     }  
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/registro.css">
    <title>Crear avatar</title>
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
    header('location:../inicio/index.php');
}
        
        ?>
    </header>
    <div class="box">
        <span class="borderLine"></span>

        <form method="post" name="formreg" id="formreg" class="signup-form" enctype="multipart/form-data" autocomplete="off"> 
            <h2>Crear rango</h2>
            
            <div class="inputBox">
                <input type="varchar" name="nomb_rango" placeholder="Digite el nombre">
                <span>Digite el nombre del rango</span>
                <i></i>
            </div>

            <div class="inputBox">
                <input type="number" name="lvl_min" placeholder="Digite el nombre">
                <span>Digite el nivel minimo</span>
                <i></i>
            </div>

            <div class="inputBox">
                <input type="number" name="lvl_max" placeholder="Digite el nombre">
                <span>Digite el nivel maximo</span>
                <i></i>
            </div>

            <div class="inputBox">
            <input type="file" accept="image/*"  name="image" required>
                <span>Adjute la imagen</span>
                <i></i>
            </div>

            <input type="submit" name="validar" value="Registro" class="registro">
            <input type="hidden" name="MM_insert" value="formreg">

            <div class="links_container">
        </div>
        </form>
    </div>
</body>
</html>