<?php
include '../../php/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btnproveedor'])) {

    // Obtener valores del formulario
    $nombreproveedor = trim($_POST['nombreproveedor'] ?? '');
    $emailproveedor = trim($_POST['emailproveedor'] ?? '');
    $telefonoproveedor = trim($_POST['telefonoproveedor'] ?? '');

    // Validar conexión
    if (!isset($conn) || !$conn) {
        die("No se pudo establecer la conexión a la base de datos.");
    }

    mysqli_set_charset($conn, "utf8mb4");

    // Validar campos obligatorios
    if ($nombreproveedor === '' || $emailproveedor === '' || $telefonoproveedor === '') {
        echo '<div class="alert alert-danger">Por favor complete todos los campos obligatorios.</div>';
        exit;
    }

    // Preparar la consulta SQL
    $stmt = mysqli_prepare($conn, "INSERT INTO proveedor (nombreproveedor, emailproveedor, telefonoproveedor) VALUES (?, ?, ?)");
    if (!$stmt) {
        die("Error al preparar la consulta: " . mysqli_error($conn));
    }

    // Asignar los parámetros
    mysqli_stmt_bind_param($stmt, "sss", $nombreproveedor, $emailproveedor, $telefonoproveedor);

    // Ejecutar y verificar
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        header("Location: ../Proveedores.php");
        exit();
    } else {
        echo '<div class="alert alert-danger"> Error al registrar proveedor: ' . mysqli_error($conn) . '</div>';
    }

    mysqli_stmt_close($stmt);
}
?>
