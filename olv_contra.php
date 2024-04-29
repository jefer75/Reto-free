<?php
 session_start();
 require_once "db/connection.php";
 // include("../../../controller/validarSesion.php");
 $db = new Database();
 $con = $db->conectar();

 if ((isset($_POST["MM_insert"]))&&($_POST["MM_insert"]=="formreg"))
 {

      $correo=$_POST['email'];

     $sql= $con -> prepare ("SELECT * FROM usuarios WHERE correo='$correo'");
     $sql -> execute();
     $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);

    $digitos ="sakur02ue859y2u389rhdewirh102385y1285013289";
    $longitud= 6;
    $codigo= substr(str_shuffle($digitos), 0, $longitud);

     $insert= $con -> prepare ("UPDATE usuarios SET token='1234' Where correo='$correo'");
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
      echo '<script>window.location="codigo.php"</script>';
    }
    else{
        echo '<script> alert ("Error al enviar el correo, puede que el correo digitado no esta registrado");</script>';
    }
  }
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Restablecer</title>
  <link rel="stylesheet" href="css/olv_contra.css">

</head>
<body>
  <div class="box">
    <h2>Digite su usuario y correo</h2>
    
    <form method="POST" name="form1" id="form1" autocomplete="off" class="registration"> 
        
        <input class="effect-1" name= "email" type="text" placeholder="email">
      
      <br>
      <td></td>

      <input type="submit" name="actualizar" value="actualizar">
      <input type="hidden" name="MM_insert" value="formreg">
    
    </form>
      <br>
  </div>
  

</body>
</html>