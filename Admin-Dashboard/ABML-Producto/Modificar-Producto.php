<?php
include '../../php/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idproducto = intval($_POST['idproducto'] ?? 0);
    $nombreproducto = trim($_POST['nombreproducto'] ?? '');
    $precioproducto = trim($_POST['precioproducto'] ?? '');
    $tipoproducto = trim($_POST['tipoproducto'] ?? '');
    $idproveedor = intval($_POST['idproveedor'] ?? 0);

    if ($idproducto === 0 || $nombreproducto === '' || $precioproducto === '' || $tipoproducto === '' || $idproveedor === 0) {
        echo "<script>
            alert('Por favor complete todos los campos');
            window.location.href = '../inventario.php';
        </script>";
        exit;
    }

    $stmt = mysqli_prepare($conn, "UPDATE producto SET nombreproducto = ?, precioproducto = ?, tipoproducto = ?, idproveedor = ? WHERE idproducto = ?");
    mysqli_stmt_bind_param($stmt, "sdsii", $nombreproducto, $precioproducto, $tipoproducto, $idproveedor, $idproducto);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        echo "<script>
            alert('Producto modificado correctamente');
            window.location.href = '../inventario.php';
        </script>";
        exit;
    } else {
        echo "<script>
            alert('Error al modificar el producto');
            window.location.href = '../inventario.php';
        </script>";
    }
}
?>
