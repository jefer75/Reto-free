<?php
    session_start();
    require_once ("db/connection.php");
    //include("../../../controller/validar_licencia.php");
    $db = new DataBase();
    $con = $db -> conectar();
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
<header>
        <form method="POST" action="">
        
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
    <main>
        <div class="container">
            <form method="POST" name="form1" id="form1" action="controller/inicio.php" autocomplete="off" class="registration">
                <h2>Error al Iniciar de sesion</h2>

                <input type="varchar" name="username" placeholder="Nombre de usuario">
                <input type="password" name="contrasena" placeholder="Contraseña">

                <button type="submit" name="inicio" value="validar" class="ingresar">Ingresar</button>

                <a href="olv_contra.php">Olvide contraseña</a>
                </form>
        </div>
    </main>
</body>
</html>