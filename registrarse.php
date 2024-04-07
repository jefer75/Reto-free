<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
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
        <form action="">
            <h2>Registrarse</h2>
    
            <input type="varchar" name="username" placeholder="Digite su nombre de usuario">
            <input type="int" name="edad" placeholder="Digite su edad">
            <input type="password" name="contrasena" placeholder="Digite una contraseña">
            <input type="password" name="conf_contrasena" placeholder="Repita la contraseña">

            <input type="submit" name="validar" value="Registrarse">

            <a href="login.php">Iniciar Sesion</a>
        </form>
    </div>
</body>
</html>