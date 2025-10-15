<?php
    include "../php/conexion.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Definición de variables
    $nombrebarbero = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $apellidobarbero = isset($_POST['apellido']) ? $_POST['apellido'] : '';
    $emailbarbero = isset($_POST['email']) ? $_POST['email'] : '';
    $contrasena = isset($_POST['password']) ? $_POST['password'] : '';
    $turno = isset($_POST['turno']) ? $_POST['turno'] : '';

    //Conexión a la base de datos
    $conexion = mysqli_connect("localhost", "root", "", "bdbarberia");

    if (!$conexion) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    //Asegurar charset
    mysqli_set_charset($conexion, "utf8mb4");

    //Preparar la consulta (guardar la contraseña en texto plano según solicitud)
    $stmt = mysqli_prepare($conexion, "INSERT INTO barbero (nombrebarbero, apellidobarbero, emailbarbero, contrasena, turno) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sssss", $nombrebarbero, $apellidobarbero, $emailbarbero, $contrasena, $turno);

    //Ejecutar
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($conexion);

        header("Location: ../Admin-Dashboard/index.php"); 
        exit();
    } else {
        echo "Error: " . mysqli_error($conexion);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
}
?>