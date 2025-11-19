<?php

include '../../php/conexion.php';

// Comprobar que la petición sea POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtener el id de la cita enviado por POST
    $idcita = $_POST['idcita'];

    // Validar que el campo idcita no esté vacío
    if (!empty($idcita)) {

        // Preparar sentencia SQL para eliminar la cita por id
        $stmt = mysqli_prepare($conn, "DELETE FROM cita WHERE idcita = ?");
        // Vincular parámetro (tipo entero)
        mysqli_stmt_bind_param($stmt, "i", $idcita);

        // Ejecutar la sentencia
        if (mysqli_stmt_execute($stmt)) {
            // Cerrar el statement y la conexión
            mysqli_stmt_close($stmt);
            mysqli_close($conn);

            // Mostrar mensaje de éxito y redirigir a la lista de citas
            // Nota: evitar enviar salida antes de header() para que la redirección funcione correctamente
            echo '<div class="alert alert-success">Usuario eliminado correctamente</div>';
            header("Location: ../../html/Citas-Usuario.php");
            exit;

        } else {
            // Error al ejecutar la eliminación
            echo '<div class="alert alert-danger">Error al eliminar usuario</div>';
        }

    } else {
        // Campo idcita vacío
        echo '<div class="alert alert-warning">El campo ID está vacío</div>';
    }
}
?>