<?php

$host = 'localhost';
$user = 'root';
$pass = ''; 
$db   = 'bdbarberia';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_errno) {
    
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    die("Error de conexión MySQL: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

$proveedores = $conn->query("SELECT idproveedor, nombreproveedor FROM proveedor");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
    <link rel="stylesheet" href="..//Admin-Dashboard/css/Agr-item.css">
    
</head>

<body>
    <div class="modal" style="display: block;">
        <div class="modal-content">
            <a class="close" aria-label="Cerrar">&times;</a>
            <h2>Registro de Producto</h2>

            <form action="..//Admin-Dashboard/ABML-Producto/Alta-Producto.php" method="post" enctype="multipart/form-data">
                <input type="text" name="nombreproducto" required placeholder="Nombre del producto" /><br /><br />
                <input type="text" name="precioproducto" required placeholder="Precio del producto" /><br /><br />
                <input type="text" name="tipoproducto" required placeholder="Tipo de producto" /><br /><br />

                <select name="idproveedor" required>
                    <option value="">Seleccione un proveedor</option>
                    <?php while($prov = $proveedores->fetch_object()): ?>
                        <option value="<?= $prov->idproveedor ?>"><?= $prov->nombreproveedor ?></option>
                    <?php endwhile; ?>
                </select><br /><br />

                <input type="file" name="imagenproducto" required placeholder="Imagen del producto" /><br /><br />

                <button type="submit" name="btnproducto">Agregar</button>

            </form>
        </div>
    </div>
    <script>
        document.querySelector('.close').addEventListener('click', function() {
            window.location.href = 'inventario.php';
        });
    </script>
</body>
</html>
