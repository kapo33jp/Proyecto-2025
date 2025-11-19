<?php

include '../../php/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtener valores del formulario
    $nombreproducto = trim($_POST['nombreproducto'] ?? '');
    $precioproducto = trim($_POST['precioproducto'] ?? '');
    $tipoproducto = trim($_POST['tipoproducto'] ?? '');
    $idproveedor = intval($_POST['idproveedor'] ?? 0);
    $imagenproducto = null;

    // Leer la imagen subida (si existe y sin errores)
    if (isset($_FILES['imagenproducto']) && $_FILES['imagenproducto']['error'] === UPLOAD_ERR_OK) {
        $imagenproducto = file_get_contents($_FILES['imagenproducto']['tmp_name']);
    }

    // Validar conexión a la base de datos
    if (!isset($conn) || !$conn) {
        die("No se pudo establecer la conexión a la base de datos.");
    }
    mysqli_set_charset($conn, "utf8mb4");

    // Verificar campos obligatorios
    if ($nombreproducto === '' || $precioproducto === '' || $tipoproducto === '' || $idproveedor === 0 || $imagenproducto === null) {
        echo '<div class="alert alert-danger">Por favor complete todos los campos obligatorios y seleccione una imagen.</div>';
        exit;
    }

    // Preparar la consulta INSERT
    $stmt = mysqli_prepare($conn, "INSERT INTO producto (nombreproducto, precioproducto, tipoproducto, idproveedor, imagenproducto) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Error al preparar la consulta: " . mysqli_error($conn));
    }

    // Vincular parámetros (s=string, d=double, i=int)
    mysqli_stmt_bind_param($stmt, "sdsis", $nombreproducto, $precioproducto, $tipoproducto, $idproveedor, $imagenproducto);

    // Ejecutar y comprobar resultado
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
