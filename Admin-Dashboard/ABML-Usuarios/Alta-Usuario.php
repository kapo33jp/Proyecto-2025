<?php

// Incluir archivo de conexión a la base de datos
include '../../php/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y sanear los datos enviados por POST
    $nombre = trim($_POST['nombre'] ?? '');
    $apellido = trim($_POST['apellido'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $contrasena = trim($_POST['contrasena'] ?? ''); // contraseña enviada por el formulario
    $idrol = intval($_POST['idrol'] ?? 2);

    // Verificar que la conexión existe
    if (!$conn) {
        die("No se pudo establecer la conexión a la base de datos.");
    }

    // Asegurar codificación UTF-8 para la conexión
    mysqli_set_charset($conn, "utf8mb4");

    // Validar que no haya campos vacíos
    if ($nombre === '' || $apellido === '' || $email === '' || $contrasena === '') {
        echo '<div class="alert alert-danger">Por favor complete todos los campos.</div>';
        exit;
    }

    // Preparar la consulta para evitar inyección SQL
    $stmt = mysqli_prepare($conn, "INSERT INTO usuarios (nombre, apellido, email, contrasena, idrol) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        echo "Error al preparar la consulta: " . mysqli_error($conn);
        exit;
    }

    // Vincular parámetros y ejecutar
    mysqli_stmt_bind_param($stmt, "ssssi", $nombre, $apellido, $email, $contrasena, $idrol);

    if (mysqli_stmt_execute($stmt)) {
        // Éxito: redirigir con mensaje
        echo "<script>alert('Usuario agregado correctamente'); window.location='../index.php';</script>";
    } else {
        // Error al ejecutar la consulta
        echo '<div class="alert alert-danger">Error al registrar usuario: ' . mysqli_error($conn) . '</div>';
    }

    // Cerrar el statement
    mysqli_stmt_close($stmt);
}
?>
