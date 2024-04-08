<?php
require_once("../db/connection.php");
$db = new Database();
$con = $db -> conectar();
session_start();

if (isset($_POST["inicio"])) {

    $username = $_POST["username"];
    //$contrasena = $_POST("contrasena");
    $contrasena = htmlentities(addslashes($_POST['contrasena']));

    $sql = $con->prepare("SELECT * FROM usuarios where username = '$username' AND id_estado=1");
    $sql->execute();
    $fila = $sql->fetch();


    if(gettype($fila) == "array" && password_verify($contrasena, $fila['contrasena'])){

        $_SESSION['username'] = $fila['username'];
        $_SESSION['id_tipo_user'] = $fila ['id_tipo_user'];
        echo "contrasena:",$contrasena;

        if ($_SESSION['id_tipo_user'] == 1) {
            header ("Location: ../model/administrador/index.php");
            exit();
        }
        
        else if ($_SESSION['id_tipo_user'] == 2) {
         header ("Location: ../model/usuario/index.php");
         exit();
         }
    }
    else {
        header("location: ../login_error.php");
        exit();
    }
}