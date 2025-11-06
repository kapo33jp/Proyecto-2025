<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Definición de variables
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $contrasena = isset($_POST['password']) ? $_POST['password'] : '';

    //Conexión a la base de datos
    $conexion = mysqli_connect("localhost", "root", "", "bdbarberia1");

    if (!$conexion) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    //Asegurar charset
    mysqli_set_charset($conexion, "utf8mb4");


    $stmt = mysqli_prepare($conexion, "INSERT INTO usuarios (nombre, apellido, email, contrasena, idrol) VALUES (?, ?, ?, ?, 3)");
    mysqli_stmt_bind_param($stmt, "ssss", $nombre, $apellido, $email, $contrasena);

    //Ejecutar  
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($conexion);

        header("Location: ../html/Main.php"); 
        exit();
    } else {
        echo "Error: " . mysqli_error($conexion);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
}
?>