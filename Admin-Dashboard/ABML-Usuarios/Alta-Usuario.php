<?php
include '../../php/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre'] ?? '');
    $apellido = trim($_POST['apellido'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $contrasena = trim($_POST['contrasena'] ?? ''); // 🔹 corregido
    $idrol = intval($_POST['idrol'] ?? 2);

    if (!$conn) {
        die("No se pudo establecer la conexión a la base de datos.");
    }

    mysqli_set_charset($conn, "utf8mb4");

    if ($nombre === '' || $apellido === '' || $email === '' || $contrasena === '') {
        echo '<div class="alert alert-danger">Por favor complete todos los campos.</div>';
        exit;
    }

    $stmt = mysqli_prepare($conn, "INSERT INTO usuarios (nombre, apellido, email, contrasena, idrol) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        echo "Error al preparar la consulta: " . mysqli_error($conn);
        exit;
    }

    mysqli_stmt_bind_param($stmt, "ssssi", $nombre, $apellido, $email, $contrasena, $idrol);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Usuario agregado correctamente'); window.location='../index.php';</script>";
    } else {
        echo '<div class="alert alert-danger">Error al registrar usuario: ' . mysqli_error($conn) . '</div>';
    }

    mysqli_stmt_close($stmt);
}
?>
