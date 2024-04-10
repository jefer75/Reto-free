<?php
require_once("../db/connection.php");
$db = new Database();
$con = $db -> conectar();
session_start();

if (isset($_POST["inicio"])) {

    $username = $_POST["username"];    
    //$contrasena = $_POST("contrasena");
    $contrasena = htmlentities(addslashes($_POST['contrasena']));

    $sql = $con->prepare("SELECT * FROM usuarios where username = '$username'");
    $sql->execute();
    $fila = $sql->fetch();


        if(gettype($fila) == "array" && password_verify($contrasena, $fila['contrasena'])){

            $_SESSION['username'] = $fila['username'];
            $_SESSION['id_estado'] = $fila['id_estado'];
            $_SESSION['id_tipo_user'] = $fila ['id_tipo_user'];

            switch ($_SESSION['id_estado']){
                
                case $_SESSION['id_estado'] = 1:
                    
                    if ($_SESSION['id_tipo_user'] == 1) {
                        header ("Location: ../model/administrador/index.php");
                        exit();
                    }
                    
                    else if ($_SESSION['id_tipo_user'] == 2) {
                        header ("Location: ../model/usuario/index.php");
                    exit();
                    }

                case $_SESSION['id_estado'] = 2:

                    echo '<script>alert ("Este usuario NO esta activo, por favor espere que el administrador lo active");</script>';
                    echo '<script>window.location="../login.php"</script>';
            }
        }

        else {
            header("location: ../login_error.php");
            exit();
        }
    }
