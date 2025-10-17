<?php
    //conexion a la base de datos
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

// Procesar solo si se envió el formulario (Btn-Reserva)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Btn-Reserva'])) {

    //Definición de variables
    $idcita = isset($_POST['idcita']) ? trim($_POST['idcita']) : '';
    $Fecha = isset($_POST['Fecha']) ? trim($_POST['Fecha']) : '';
    $Hora = isset($_POST['Hora']) ? trim($_POST['Hora']) : '';
    $Servicio = isset($_POST['Servicio']) ? trim($_POST['Servicio']) : '';
    $Barbero = isset($_POST['Barbero']) ? trim($_POST['Barbero']) : '';

    $stmt = mysqli_prepare($conn, "INSERT INTO cita (idcita, Fecha, Hora, Servicio, Barbero) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sssss", $idcita, $Fecha, $Hora, $Servicio, $Barbero);

    //Ejecutar
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        // Redirigir al dashboard (ruta relativa desde ABML-cita)
        header("Location: ../../Admin-Dashboard/index.php"); 
        exit();
    } else {
        echo "Error: " . mysqli_error($conexion);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
}
?>