<?php
include '../../php/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtener valores del formulario
    $nombreproducto = trim($_POST['nombreproducto'] ?? '');
    $precioproducto = trim($_POST['precioproducto'] ?? '');
    $tipoproducto = trim($_POST['tipoproducto'] ?? '');
    $idproveedor = intval($_POST['idproveedor'] ?? 0);
    $imagenproducto = null;

    // Leer correctamente la imagen
    if (isset($_FILES['imagenproducto']) && $_FILES['imagenproducto']['error'] === UPLOAD_ERR_OK) {
        $imagenproducto = file_get_contents($_FILES['imagenproducto']['tmp_name']);
    }

    // Validar conexión
    if (!isset($conn) || !$conn) {
        die("No se pudo establecer la conexión a la base de datos.");
    }
    mysqli_set_charset($conn, "utf8mb4");

    // Validar campos obligatorios
    if ($nombreproducto === '' || $precioproducto === '' || $tipoproducto === '' || $idproveedor === 0 || $imagenproducto === null) {
        echo '<div class="alert alert-danger">Por favor complete todos los campos obligatorios y seleccione una imagen.</div>';
        exit;
    }

    // Preparar la consulta SQL
    $stmt = mysqli_prepare($conn, "INSERT INTO producto (nombreproducto, precioproducto, tipoproducto, idproveedor, imagenproducto) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Error al preparar la consulta: " . mysqli_error($conn));
    }

    // Asignar los parámetros
    mysqli_stmt_bind_param($stmt, "sdsss", $nombreproducto, $precioproducto, $tipoproducto, $idproveedor, $imagenproducto);

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
