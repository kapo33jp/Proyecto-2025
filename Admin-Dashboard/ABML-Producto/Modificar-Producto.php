<?php

session_start();
include '../../php/conexion.php';

// Obtener ID del producto desde GET; si no viene, redirigir al inventario
$idproducto = isset($_GET['idproducto']) ? intval($_GET['idproducto']) : 0;
if ($idproducto === 0) {
    header("Location: ../inventario.php");
    exit;
}

// Consultar datos actuales del producto
$sql = $conn->query("SELECT * FROM producto WHERE idproducto = $idproducto");
$producto = $sql->fetch_object();

// Si no existe el producto, volver al inventario
if (!$producto) {
    header("Location: ../inventario.php");
    exit;
}

// Obtener lista de proveedores para el select
$proveedores = $conn->query("SELECT * FROM proveedor");

// Procesar envío del formulario (método POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar y sanitizar datos del formulario
    $idproducto = intval($_POST['idproducto'] ?? 0);
    $nombreproducto = trim($_POST['nombreproducto'] ?? '');
    $precioproducto = trim($_POST['precioproducto'] ?? '');
    $tipoproducto = trim($_POST['tipoproducto'] ?? '');
    $idproveedor = intval($_POST['idproveedor'] ?? 0);

    // Validar campos obligatorios
    if ($idproducto === 0 || $nombreproducto === '' || $precioproducto === '' || $tipoproducto === '' || $idproveedor === 0) {
        // Mensaje de error si falta algún campo
        echo "<script>
            alert('Por favor complete todos los campos');
        </script>";
    } else {
        // Preparar y ejecutar la actualización usando prepared statements
        $stmt = mysqli_prepare($conn, "UPDATE producto SET nombreproducto = ?, precioproducto = ?, tipoproducto = ?, idproveedor = ? WHERE idproducto = ?");
        mysqli_stmt_bind_param($stmt, "sdsii", $nombreproducto, $precioproducto, $tipoproducto, $idproveedor, $idproducto);

        if (mysqli_stmt_execute($stmt)) {
            // Cerrar statement y redirigir con mensaje de éxito
            mysqli_stmt_close($stmt);
            echo "<script>
                alert('Producto modificado correctamente');
                window.location.href = '../inventario.php';
            </script>";
            exit;
        } else {
            // Mensaje de error en la actualización
            echo "<script>
                alert('Error al modificar el producto');
            </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Producto</title>
    <link rel="stylesheet" href="../../Admin-Dashboard/css/Mod-item.css">
</head>
<body>
    <h2>Modificar Producto</h2>
    
    <!-- Formulario para editar producto -->
    <form method="POST" action="">
        <!-- ID oculto para identificar el registro -->
        <input type="hidden" name="idproducto" value="<?= $producto->idproducto ?>">
        
        <div>
            <label for="nombreproducto">Nombre del Producto:</label>
            <input type="text" id="nombreproducto" name="nombreproducto" 
                value="<?= htmlspecialchars($producto->nombreproducto) ?>" required>
        </div>
        
        <div>
            <label for="precioproducto">Precio:</label>
            <input type="number" step="0.01" id="precioproducto" name="precioproducto" 
                value="<?= htmlspecialchars($producto->precioproducto) ?>" required>
        </div>
        
        <div>
            <label for="tipoproducto">Tipo de Producto:</label>
            <input type="text" id="tipoproducto" name="tipoproducto" 
                value="<?= htmlspecialchars($producto->tipoproducto) ?>" required>
        </div>
        
        <div>
            <label for="idproveedor">Proveedor:</label>
            <select id="idproveedor" name="idproveedor" required>
                <option value="">Seleccione un proveedor</option>
                <?php while($proveedor = $proveedores->fetch_object()): ?>
                    <option value="<?= $proveedor->idproveedor ?>" 
                        <?= $proveedor->idproveedor == $producto->idproveedor ? 'selected' : '' ?>>
                        <?= htmlspecialchars($proveedor->nombreproveedor) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        
        <div>
            <button type="submit">Modificar</button>
        </div>
    </form>
</body>
</html>