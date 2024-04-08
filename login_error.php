<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
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
    <main>
        <div class="container">
            <h2>Error al inicio de sesion</h2>

            <input type="varchar" name="username" placeholder="Nombre de usuario">
            <input type="password" name="contrasena" placeholder="Contraseña">

            <button type="submit" name="inicio" value="validar" class="ingresar">Ingresar</button>

            <a href="olv_contra.php">Olvide contraseña</a>
        </div>
    </main>
</body>
</html>