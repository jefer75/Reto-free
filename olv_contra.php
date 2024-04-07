<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
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
            header('location:login.php');
        }
        
        ?>
    </header>
    
    <div>
        <form action="">
            <h2>Recuperar Contraseña</h2>

            <input type="email" name="email" placeholder="Digite su correo electronico">
            <input type="submit" name="validar" value="Recuperar">

            <a href="login.php">Iniciar Sesion</a>
        </form>
    </div>

</body>
</html>