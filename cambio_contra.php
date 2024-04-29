<?php
 session_start();
 require_once "db/connection.php";
 // include("../../../controller/validarSesion.php");
 $db = new Database();
 $con = $db->conectar();


if (isset($_POST['actualizar'])){ 
  
  $cedula=$_POST['cedula']; 
  $contrasena= $_POST['contrasena']; 
  $confirmar_contrasena= $_POST['confirmar_contrasena']; 
  
    if($contrasena == $confirmar_contrasena) {
     


     $sql= $con -> prepare ("SELECT * FROM usuarios");
     $sql -> execute();
     $fila = $sql -> fetchAll(PDO::FETCH_ASSOC);
   
     if ($cedula=="" || $contrasena=="" || $confirmar_contrasena=="")
      {
         echo '<script>alert ("EXISTEN DATOS VACIOS");</script>';
         echo '<script>window.location="registro_empleados.php"</script>';
      }

      else{
        $consulta = $con->prepare("SELECT * FROM usuarios WHERE cedula = '$cedula'");
        $consulta -> execute();
        $consul = $consulta -> fetchAll(PDO::FETCH_ASSOC);

        $pass_cifrado = password_hash($contrasena,PASSWORD_DEFAULT, array("pass"=>12));

        $insertSQL = $con->prepare("UPDATE usuarios SET contrasena='$pass_cifrado' WHERE cedula = '$cedula' ");
        $insertSQL -> execute();
        echo '<script> alert("REGISTRO EXITOSO");</script>';
        echo '<script>window.location="login.php"</script>';
     }  
    }
    else {
      echo '<script>alert ("Uno o mas de los datos digitados son erroneos");</script>';
    }
     
  }

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/olv_contra.css">
  <title>Recuperar Contraseña</title>

</head>
<body>
  <div class="formulario">
  <div class="box">
    <div class="col-lg-6 login-form">
      <img class="image-logo" src="https://cdn-icons-png.flaticon.com/512/6375/6375816.png" />
      <br>
      <br>
      <br>
      <h1>Recuperar Contraseña</h1>
    
      <div class="input-form password-toggle">
        <br>
        <form method="POST" name="form1" id="form1" autocomplete="off" class="registration"> 
        <div class="password-container">
            <input class="effect-1" name= "cedula" type="number" placeholder="Cedula">
            <input class="effect-1" name= "contrasena" type="password" placeholder="nueva Contraseña">
            <span class="toggle-password" onclick="togglePasswordVisibility(this)"></span>
            <input class="effect-1"  name= "confirmar_contrasena" type="password" placeholder="Confirmar Contraseña">
            <span class="focus-border"></span>
            
          </div>
         
       
      </div>
      <br>
      <input type="submit" name="actualizar" value="actualizar">
      <input type="hidden" name="MM_insert" value="formreg">
        </form>
      
     
      <br>
     </div>
    </div>
  </div>

</body>
</html>