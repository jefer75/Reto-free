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
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
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
        
        if(isset($_POST['regresar']))
        {        
            header('location:index.html
            ');
        }
        
        ?>
    </header>
    <main>

    <div class="box">
        <span class="borderLine"></span>

        <form method="POST" name="form1" id="form1" action="controller/inicio.php" autocomplete="off" class="registration">
            
        <h2>Iniciar Session</h2>
        <div class="inputBox">
        <input type="varchar" name="username" placeholder="Nombre de usuario">
        <span>Nombre de usuario</span>
        <i></i>
        </div>
        <div class="inputBox">
        <input type="password" name="contrasena" placeholder="Contraseña">
        <span>Contraseña</span>
        <i></i>
        </div>
        <div class="links_container">
            <a href="olv_contra.php" class="links">Olvidé contraseña</a>
            <a href="registrarse.php" class="registrarse">Registrarse</a>
        </div>
        <input type="submit" name="inicio" value="validar" class="ingresar">
        <!-- <button type="submit" name="inicio" value="validar" class="ingresar">Ingresar</button> -->
    </form>
        </div>
    </main>
</body>
</html>