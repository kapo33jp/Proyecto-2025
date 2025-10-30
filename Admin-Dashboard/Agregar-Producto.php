<?php
include '../../php/conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Agregar Producto</title>
</head>
<body>
    <h2>Registro de Producto</h2>

    <form action="/Admin-Dashboard/AMBL-Producto/Alta-Producto.php" method="post">

        <label for="nombreproducto">Nombre del producto:</label><br>
        <input type="text" id="nombreproducto" name="nombreproducto" required placeholder="Nombre del producto"><br><br>

        <label for="precioproducto">Precio del producto:</label><br>
        <input type="number" step="0.01" id="precioproducto" name="precioproducto" required placeholder="Precio del producto"><br><br>

        <label for="tipoproducto">Tipo del producto:</label><br>
        <input type="text" id="tipoproducto" name="tipoproducto" required placeholder="Tipo del producto"><br><br>

        <label for="idproveedor">Proveedor:</label><br>
        <select id="idproveedor" name="idproveedor" required>
            <option value="">Seleccione un proveedor</option>
            <?php
            $query = $conn->query("SELECT idproveedor, nombreproveedor FROM proveedor");
            while ($row = $query->fetch_object()) {
                echo "<option value='{$row->idproveedor}'>{$row->nombreproveedor}</option>";
            }
            ?>
        </select><br><br>

        <!-- Botones visibles -->
        <input type="submit" name="btnproducto" value="Registrar">
        <input type="button" value="Cancelar" onclick="window.location.href='/Admin-Dashboard/index.php'">

    </form>
</body>
</html>
