<?php
session_start();
include '../../php/conexion.php';

// Procesar solo solicitudes POST provenientes del formulario (Btn-Reserva)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Btn-Reserva'])) {

    // Obtener campos del formulario
    $idusuario = trim($_POST['idusuario'] ?? '');
    $idcita    = trim($_POST['idcita'] ?? '');
    $Fecha      = trim($_POST['Fecha'] ?? '');
    $Hora       = trim($_POST['Hora'] ?? '');
    $Servicio   = trim($_POST['Servicio'] ?? '');
    $Barbero    = trim($_POST['Barbero'] ?? '');

    // Validar usuario
    if ($idusuario === '') {
        echo "<script>alert('Error: Usuario no válido');</script>";
        echo "<script>window.location.href='../../html/Reserva.php';</script>";
        exit();
    }

    // Generar idcita si no se proporciona
    if ($idcita === '') {
        $idcita = 'CITA_' . date('YmdHis') . '_' . $idusuario;
    }

    // Preparar e insertar registro
    $stmt = mysqli_prepare($conn, "INSERT INTO cita (idcita, idusuario, Fecha, Hora, Servicio, Barbero) VALUES (?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sissss", $idcita, $idusuario, $Fecha, $Hora, $Servicio, $Barbero);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        // Redirigir al panel principal
        header("Location: ../../html/Main.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    // Si no es POST, redirigir al formulario de reserva
    header("Location: ../../html/Reserva.php");
    exit();
}
?>
