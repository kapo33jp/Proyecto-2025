<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Definición de variables
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $contrasena = $_POST['password'];

    // Conexión a la base de datos
    $conexion = mysqli_connect("localhost", "root", "", "bdbarberia");

    if (!$conexion) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    // Preparar la consulta
    $stmt = mysqli_prepare($conexion, "INSERT INTO clientes (nombre, apellido, email, contrasena) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssss", $nombre, $apellido, $email, $contrasena);

    // Ejecutar
    if (mysqli_stmt_execute($stmt)) {
        // Cerrar conexión antes de redirigir
        mysqli_stmt_close($stmt);
        mysqli_close($conexion);

        header("Location: index.html"); 
        exit();
    } else {
        echo "Error: " . mysqli_error($conexion);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
}
?>
