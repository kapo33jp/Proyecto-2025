<?php
    include "../../php/conexion.php";

// Procesar solo si se envió el formulario (Btn-Reserva)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Btn-Reserva'])) {

    //Definición de variables
    $idcita = isset($_POST['idcita']) ? trim($_POST['idcita']) : '';
    $Fecha = isset($_POST['Fecha']) ? trim($_POST['Fecha']) : '';
    $Hora = isset($_POST['Hora']) ? trim($_POST['Hora']) : '';
    $Servicio = isset($_POST['Servicio']) ? trim($_POST['Servicio']) : '';
    $Barbero = isset($_POST['Barbero']) ? trim($_POST['Barbero']) : '';

    // Conexión a la base de datos (si se necesita conexión directa local)
    $conexion = mysqli_connect("localhost", "root", "", "bdbarberia");
    if (!$conexion) {
        die("Conexión fallida: " . mysqli_connect_error());
    }
    mysqli_set_charset($conexion, "utf8mb4");

    // Preparar la consulta (idcita puede ser auto-incremental; enviar '' si no se usa)
    $stmt = mysqli_prepare($conexion, "INSERT INTO cita (idcita, Fecha, Hora, Servicio, Barbero) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sssss", $idcita, $Fecha, $Hora, $Servicio, $Barbero);

    //Ejecutar
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($conexion);

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