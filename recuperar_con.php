<?php
 session_start();
 require_once "db/connection.php";
 // include("../../../controller/validarSesion.php");
 $db = new Database();
 $con = $db->conectar();

    if (isset($_POST['recuperar']))
    {

      $correo=$_POST['email'];

     $sql= $con -> prepare ("SELECT * FROM usuarios WHERE correo='$correo'");
     $sql -> execute();
     $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);

    $digitos ="sakur02ue859y2u389rhdewirh102385y1285013289";
    $longitud= 6;
    $codigo= substr(str_shuffle($digitos), 0, $longitud);

     $insert= $con -> prepare ("UPDATE usuarios SET token='$codigo' Where correo='$correo'");
     $insert -> execute();
     $fila1 = $insert -> fetchAll(PDO::FETCH_ASSOC);

    //codigo de envio de correo
    $paracorreo = "$correo";
    $titulo ="Codigo de verificacion";
    $msj = "Su codigo de verificacion para el cambio de contraseña es: '$codigo'";
    $tucorreo="From:aeventos986@gmail.com";

    if(mail($paracorreo, $titulo, $msj, $tucorreo))
    {
      echo '<script> alert ("Su codigo ha sido enviado al correo anteriormente digitado");</script>';
      echo '<script>window.location="reset.php"</script>';
    }
    else{
        echo '<script> alert ("El correo digitado no esta registrado");</script>';
    }
  }
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Restablecer</title>
  <link rel="stylesheet" href="../../../css/recuperar_con.css">

</head>
<body>
  <div class="container">
    <div class="col-lg-6 login-form">
      <img class="image-logo" src="https://cdn-icons-png.flaticon.com/512/6375/6375816.png" />
      <br>
      <br>
      <br>
      <h1>Digite su usuario y correo</h1>
    
      <div class="input-form password-toggle">
        <br>
       <form class="col-3"  method="post">
        <input class="effect-1" name= "email" type="text" placeholder="email">
        
      </div>
      <br>
      <td></td>

      <button type="submit" name="recuperar" class="btn btn-primary">Restablecer</button>
</form>
      <br>
     
    </div>
  </div>
  

</body>
</html>