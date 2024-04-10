<?php
    session_start();
    require_once("../../db/connection.php");
    // include("../../../controller/validarSesion.php");
    $db = new Database();
    $con = $db -> conectar();

    $username= $_SESSION['username'];


    if ((isset($_POST["MM_insert"]))&&($_POST["MM_insert"]=="formreg"))
   {
    $username= $_POST['username'];
    $edad= $_POST['edad'];
    $id_avatar= $_POST['avatar'];
    $id_rango= 1;
    $puntos= 0;
    $nivel= 1;
    $correo= $_POST['correo'];
    $contrasena= $_POST['contrasena'];
    $conf_contra= $_POST['conf_contra'];
    $f_ingreso= date('Y-m-d');
    $id_estado= 1;
    $id_tipo_user= 2; 

     $sql= $con -> prepare ("SELECT * FROM usuarios WHERE username='$username'");
     $sql -> execute();
     $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);

     if ($fila){
        echo '<script>alert ("Este nombre de usuario ya esta en uso");</script>';
        echo '<script>window.location="registrarse.php"</script>';
     }

     else
   
     if ($username=="" || $edad=="" || $id_avatar=="" || $correo=="" || $contrasena=="")
      {
         echo '<script>alert ("Por favor llene todos los campos");</script>';
         echo '<script>window.location="registrarse.php"</script>';
      }
      
      else if ($contrasena==$conf_contra){

        $encriptado = password_hash($contrasena,PASSWORD_DEFAULT, array("pass"=>12));
        
        $insertSQL = $con->prepare("INSERT INTO usuarios(username, edad, id_avatar, id_rango, puntos, nivel, correo, contrasena, f_ingreso, id_estado, id_tipo_user) VALUES('$username', '$edad', $id_avatar, $id_rango, $puntos, $nivel, '$correo', '$encriptado', '$f_ingreso', $id_estado, $id_tipo_user)");
        $insertSQL -> execute();
        echo '<script> alert("REGISTRO EXITOSO");</script>';
        echo '<script>window.location="login.php"</script>';
     }  
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis partidas</title>
</head>
<body>
    
    <div class="container">

        

    </div>

</body>
</html>