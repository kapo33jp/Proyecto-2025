<?php

include '../../php/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtener idproveedor enviado desde el formulario (si existe)
    $idproveedor = $_POST['idproveedor'] ?? null;

    // Validar que el ID no esté vacío
    if (!empty($idproveedor)) {
        
        // Preparar sentencia segura para eliminar el proveedor
        $stmt = mysqli_prepare($conn, "DELETE FROM proveedor WHERE idproveedor = ?");
        mysqli_stmt_bind_param($stmt, "i", $idproveedor);

        // Ejecutar la consulta y comprobar resultado
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);

            // Notificar éxito y redirigir a la lista de proveedores
            echo "<script>
                alert('Proveedor eliminado correctamente');
                window.location.href = '../Proveedores.php';
            </script>";
            exit;
        } else {
            // Error al ejecutar la eliminación
            echo "<script>
                alert('Error al eliminar el proveedor');
                window.location.href = '../Proveedores.php';
            </script>";
        }
    } else {
        // ID no proporcionado en la solicitud POST
        echo "<script>
            alert('El campo ID está vacío');
            window.location.href = '../Proveedores.php';
        </script>";
    }
}
?>
