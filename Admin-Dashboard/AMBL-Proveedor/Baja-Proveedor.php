<?php
include '../../php/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idproveedor = $_POST['idproveedor'] ?? null;

    if (!empty($idproveedor)) {
        
        $stmt = mysqli_prepare($conn, "DELETE FROM proveedor WHERE idproveedor = ?");
        mysqli_stmt_bind_param($stmt, "i", $idproveedor);

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);

            echo "<script>
                alert('Proveedor eliminado correctamente');
                window.location.href = '../Proveedores.php';
            </script>";
            exit;
        } else {
            echo "<script>
                alert('Error al eliminar el proveedor');
                window.location.href = '../Proveedores.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('El campo ID está vacío');
            window.location.href = '../Proveedores.php';
        </script>";
    }
}
?>
