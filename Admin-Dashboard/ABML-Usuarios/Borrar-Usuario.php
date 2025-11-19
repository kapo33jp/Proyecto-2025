<?php

    // Incluir conexión a la base de datos
    include '../../php/conexion.php';

    // Comprobar que la petición sea POST
    if(($_SERVER["REQUEST_METHOD"] == "POST")){

        // Obtener el ID del usuario enviado desde el formulario
        $idusuario = ($_POST['idusuario']);

        // Verificar que el ID no esté vacío
        if (!empty($idusuario)) {

            // Preparar la consulta para eliminar el usuario (protección contra inyección)
            $stmt = mysqli_prepare($conn, "DELETE FROM usuarios WHERE idusuario = ?");
            mysqli_stmt_bind_param($stmt, "i", $idusuario);

            // Ejecutar la sentencia preparada
            if (mysqli_stmt_execute($stmt)) {
                // Cerrar sentencia y conexión
                mysqli_stmt_close($stmt);
                mysqli_close($conn);

                // Redirigir al índice después de eliminar (sin imprimir nada antes para no romper headers)
                header("Location: ../index.php");
                exit;

            } else {
                // Mostrar mensaje de error si la ejecución falla
                echo '<div class="alert alert-danger">Error al eliminar usuario</div>';
            }

        } else {
            // Mensaje si el campo ID está vacío
            echo '<div class="alert alert-warning">El campo ID está vacío</div>';
        }
    }
?>