<?php
session_start();
include '../../php/conexion.php';

// Verificar si se recibió el ID del producto por GET
$idproducto = isset($_GET['idproducto']) ? intval($_GET['idproducto']) : 0;

if ($idproducto === 0) {
    header("Location: ../inventario.php");
    exit;
}

// Obtener datos del producto
$sql = $conn->query("SELECT * FROM producto WHERE idproducto = $idproducto");
$producto = $sql->fetch_object();

if (!$producto) {
    header("Location: ../inventario.php");
    exit;
}

// Obtener proveedores para el dropdown
$proveedores = $conn->query("SELECT * FROM proveedor");

// Procesar el formulario cuando se envía por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idproducto = intval($_POST['idproducto'] ?? 0);
    $nombreproducto = trim($_POST['nombreproducto'] ?? '');
    $precioproducto = trim($_POST['precioproducto'] ?? '');
    $tipoproducto = trim($_POST['tipoproducto'] ?? '');
    $idproveedor = intval($_POST['idproveedor'] ?? 0);

    if ($idproducto === 0 || $nombreproducto === '' || $precioproducto === '' || $tipoproducto === '' || $idproveedor === 0) {
        echo "<script>
            alert('Por favor complete todos los campos');
        </script>";
    } else {
        $stmt = mysqli_prepare($conn, "UPDATE producto SET nombreproducto = ?, precioproducto = ?, tipoproducto = ?, idproveedor = ? WHERE idproducto = ?");
        mysqli_stmt_bind_param($stmt, "sdsii", $nombreproducto, $precioproducto, $tipoproducto, $idproveedor, $idproducto);

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            echo "<script>
                alert('Producto modificado correctamente');
                window.location.href = '../inventario.php';
            </script>";
            exit;
        } else {
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
    
    <form method="POST" action="">
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