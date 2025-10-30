<?php
include '../../php/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idproducto = $_POST['idproducto'] ?? null;

    if (!empty($idproducto)) {
        
        $stmt = mysqli_prepare($conn, "DELETE FROM productos WHERE idproducto = ?");
        mysqli_stmt_bind_param($stmt, "i", $idproducto);

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);

            echo "<script>
                alert('Producto eliminado correctamente');
                window.location.href = '../productos.php';
            </script>";
            exit;
        } else {
            echo "<script>
                alert('Error al eliminar el producto');
                window.location.href = '../productos.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('El campo ID está vacío');
            window.location.href = '../productos.php';
        </script>";
    }
}
?>
