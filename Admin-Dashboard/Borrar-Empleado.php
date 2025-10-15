<?php
    include "../php/conexion.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Obtener el id del empleado a borrar
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

        //Conexión a la base de datos
        $conexion = mysqli_connect("localhost", "root", "", "bdbarberia");

        if (!$conexion) {
            die("Conexión fallida: " . mysqli_connect_error());
        }

        //Asegurar charset
        mysqli_set_charset($conexion, "utf8mb4");

        //Preparar la consulta para borrar el empleado
        $stmt = mysqli_prepare($conexion, "DELETE FROM barbero WHERE idbarbero = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);

        //Ejecutar
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($conexion);

            header("Location: ../Admin-Dashboard/index.php"); 
            exit();
        } else {
            echo "Error: " . mysqli_error($conexion);
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conexion);
    }
?>


//Esperar a q franklin hable de esto en clase
