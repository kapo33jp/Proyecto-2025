<?php

include '../../php/conexion.php';

// Solo procesar si la petición es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtener el id del producto desde el formulario (null si no viene)
    $idproducto = $_POST['idproducto'] ?? null;

    // Validar que el id no esté vacío
    if (!empty($idproducto)) {
        
        // Preparar la sentencia para evitar inyección SQL
        $stmt = mysqli_prepare($conn, "DELETE FROM producto WHERE idproducto = ?");
        mysqli_stmt_bind_param($stmt, "i", $idproducto);

        // Ejecutar la sentencia y comprobar resultado
        if (mysqli_stmt_execute($stmt)) {
            // Cerrar statement y conexión
            mysqli_stmt_close($stmt);
            mysqli_close($conn);

            // Informar al usuario y redirigir al inventario
            echo "<script>
                alert('Producto eliminado correctamente');
                window.location.href = '../inventario.php';
            </script>";
            exit;
        } else {
            // Error al ejecutar la eliminación
            echo "<script>
                alert('Error al eliminar el producto');
                window.location.href = '../inventario.php';
            </script>";
        }
    } else {
        // ID no proporcionado en el formulario
        echo "<script>
            alert('El campo ID está vacío');
            window.location.href = '../inventario.php';
        </script>";
    }
}
?>
