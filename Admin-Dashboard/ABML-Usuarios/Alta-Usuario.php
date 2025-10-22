<?php

    include '../../php/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Definición de variables según el formulario
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $apellido = isset($_POST['apellido']) ? trim($_POST['apellido']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $contrasena = isset($_POST['password']) ? trim($_POST['password']) : '';
    // Por defecto se asigna rol 2 (usuario). Cambiar si el formulario envía idrol.
    $idrol = isset($_POST['idrol']) ? intval($_POST['idrol']) : 2;

    if (!isset($conn) || !$conn) {
        die("No se pudo establecer la conexión a la base de datos.");
    }
    mysqli_set_charset($conn, "utf8mb4");

    // Validación mínima
    if ($nombre === '' || $apellido === '' || $email === '' || $contrasena === '') {
        echo '<div class="alert alert-danger">Por favor complete todos los campos obligatorios.</div>';
        exit;
    }

    // Preparar e insertar en tabla usuarios
    $stmt = mysqli_prepare($conn, "INSERT INTO usuarios (nombre, apellido, email, contrasena, idrol) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        echo "Error al preparar la consulta: " . mysqli_error($conn);
        exit;
    }
    mysqli_stmt_bind_param($stmt, "ssssi", $nombre, $apellido, $email, $contrasena, $idrol);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        header("Location: ../index.php");
        exit();
    } else {
        echo '<div class="alert alert-danger">Error al registrar usuario: ' . mysqli_error($conn) . '</div>';
    }

    mysqli_stmt_close($stmt);
}
?>
