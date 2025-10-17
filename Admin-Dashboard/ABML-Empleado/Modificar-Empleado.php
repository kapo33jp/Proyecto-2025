<?php
// ...existing code...
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Parámetros de conexión
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'bdbarberia';
$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    error_log('Error de conexión MySQL: ' . mysqli_connect_error());
    die('No se pudo establecer la conexión a la base de datos.');
}

// Si prefieres que mysqli lance excepciones en errores, puedes activar:
// mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idbarbero = isset($_POST['idbarbero']) ? intval($_POST['idbarbero']) : 0;
    $nombrebarbero = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $apellidobarbero = isset($_POST['apellido']) ? trim($_POST['apellido']) : '';
    $emailbarbero = isset($_POST['email']) ? trim($_POST['email']) : '';
    $contrasena = isset($_POST['password']) ? trim($_POST['password']) : '';
    $turno = isset($_POST['turno']) ? trim($_POST['turno']) : '';

    if (!isset($conn) || !$conn) {
        die("No se pudo establecer la conexión a la base de datos.");
    }

    mysqli_set_charset($conn, "utf8mb4");

    if ($idbarbero <= 0) {
        echo "ID de barbero inválido.";
        exit;
    }

    if ($nombrebarbero === '' || $apellidobarbero === '' || $emailbarbero === '' || $contrasena === '') {
        echo "Faltan datos obligatorios.";
        exit;
    }

    $stmt = mysqli_prepare($conn, "UPDATE barbero SET nombrebarbero = ?, apellidobarbero = ?, emailbarbero = ?, contrasena = ?, turno = ? WHERE idbarbero = ?");
    if (!$stmt) {
        echo "Error al preparar la consulta: " . mysqli_error($conn);
        exit;
    }

    mysqli_stmt_bind_param($stmt, "sssssi", $nombrebarbero, $apellidobarbero, $emailbarbero, $contrasena, $turno, $idbarbero);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("Location: ../index.php");
        exit();
    } else {
        echo "Error al ejecutar la consulta: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>