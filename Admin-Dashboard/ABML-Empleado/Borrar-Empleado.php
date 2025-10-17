<?php

    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db   = 'bdbarberia';

    $conn = mysqli_connect($host, $user, $pass, $db);

    if (!$conn) {
        error_log('Error de conexión MySQL: ' . mysqli_connect_error());
        die('No se pudo establecer la conexión a la base de datos.');
    }
    mysqli_set_charset($conn, "utf8mb4");

    if(($_SERVER["REQUEST_METHOD"] == "POST")){

        $idbarbero = ($_POST['idbarbero']);

        if (!empty($idbarbero)) {

            $stmt = mysqli_prepare($conn, "DELETE FROM barbero WHERE idbarbero = ?");
            mysqli_stmt_bind_param($stmt, "i", $idbarbero);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                mysqli_close($conn);

                echo '<div class="alert alert-success">Usuario eliminado correctamente</div>';
                header("Location: ../index.php");

            exit;

            }else{
                echo '<div class="alert alert-danger">Error al eliminar usuario</div>';
            }
            
            }else{
                echo '<div class="alert alert-warning">El campo ID esta vacio</div>';
        }
    }
?>