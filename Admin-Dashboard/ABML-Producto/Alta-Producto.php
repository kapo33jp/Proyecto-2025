<?php
include '../../php/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtener valores del formulario
    $nombreproducto = trim($_POST['nombreproducto'] ?? '');
    $precioproducto = trim($_POST['precioproducto'] ?? '');
    $tipoproducto = trim($_POST['tipoproducto'] ?? '');
    $idproveedor = intval($_POST['idproveedor'] ?? 0);

    // Validar conexión
    if (!isset($conn) || !$conn) {
        die("No se pudo establecer la conexión a la base de datos.");
    }
    mysqli_set_charset($conn, "utf8mb4");

    // Validar campos obligatorios
    if ($nombreproducto === '' || $precioproducto === '' || $tipoproducto === '' || $idproveedor === 0) {
        echo '<div class="alert alert-danger">Por favor complete todos los campos obligatorios.</div>';
        exit;
    }

    // Preparar la consulta SQL
    $stmt = mysqli_prepare($conn, "INSERT INTO producto (nombreproducto, precioproducto, tipoproducto, idproveedor) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        die("Error al preparar la consulta: " . mysqli_error($conn));
    }

    // Asignar los parámetros
    mysqli_stmt_bind_param($stmt, "sdsi", $nombreproducto, $precioproducto, $tipoproducto, $idproveedor);

    // Ejecutar y verificar
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        header("Location: ../inventario.php");
        exit();
    } else {
        echo '<div class="alert alert-danger">Error al registrar producto: ' . mysqli_error($conn) . '</div>';
    }

    mysqli_stmt_close($stmt);
}
?>
