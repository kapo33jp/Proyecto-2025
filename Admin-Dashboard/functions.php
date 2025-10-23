<?php

$host = 'localhost';
$user = 'root';
$pass = ''; 
$db   = 'bdbarberia';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_errno) {
    
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    die("Error de conexión MySQL: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

    function acceso_user() {
        $nombre = isset($_POST['email']) ? $_POST['email'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        if ($nombre === '' || $password === '') {
            echo '<div class="alert alert-danger">Faltan credenciales</div>';
            return;
        }

    session_start();
    $_SESSION ['email']=$nombre;
    $conn=mysqli_connect("localhost","root","","bdbarberia");
    $consulta="SELECT * FROM usuarios WHERE email='$nombre' AND contrasena='$password'";
    $resultado=mysqli_query($conn,$consulta);
    $filas=mysqli_fetch_array($resultado);

    if ($filas['id_rol'] == 1) { //Admin

        header("location: ../Admin-Dashboard/index.php");

    } else if ($filas['id_rol'] == 2) {//Empleado

        header("location: ../Admin-Dashboard/index.php");

    } else if ($filas['id_rol'] == 3) {//Cliente

        header("location: ../html/index.html");

    } else {

        header("location:");
        session_destroy();

        }
    }
?>