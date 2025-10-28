<?php
include '../../php/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtener valores del formulario
    $idproveedor = isset($_POST['idproveedor']) ? trim($_POST['idproveedor']) : '';
    $nombreproveedor = isset($_POST['nombreproveedor']) ? trim($_POST['nombreproveedor']) : '';
    $emailproveedor = isset($_POST['emailproveedor']) ? trim($_POST['emailproveedor']) : '';
    $telefonoproveedor = isset($_POST['telefonoproveedor']) ? trim($_POST['telefonoproveedor']) : '';

    // Validar conexión
    if (!isset($conn) || !$conn) {
        die("No se pudo establecer la conexión a la base de datos.");
    }

    mysqli_set_charset($conn, "utf8mb4");

    // Validar campos obligatorios
    if ($nombreproveedor === '' || $emailproveedor === '' || $telefonoproveedor === '') {
        echo '<div class="alert alert-danger">⚠️ Por favor complete todos los campos obligatorios.</div>';
        exit;
    }

    // Preparar consulta SQL
    $stmt = mysqli_prepare($conn, "INSERT INTO proveedores (nombreproveedor, emailproveedor, telefonoproveedor) VALUES (?, ?, ?)");

    if (!$stmt) {
        echo "Error al preparar la consulta: " . mysqli_error($conn);
        exit;
    }

    // Asignar parámetros (sin ID si es autoincremental)
    mysqli_stmt_bind_param($stmt, "sss", $nombreproveedor, $emailproveedor, $telefonoproveedor);

    // Ejecutar la consulta
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        header("Location: ../index.php"); // Redirige al listado de proveedores
        exit();
    } else {
        echo '<div class="alert alert-danger"> rror al registrar proveedor: ' . mysqli_error($conn) . '</div>';
    }

    mysqli_stmt_close($stmt);
}
?>
