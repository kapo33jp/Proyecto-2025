<?php

        include '../../php/conexion.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idbarbero = intval($_POST['idbarbero']);
    $nombrebarbero = trim($_POST['nombrebarbero']);
    $apellidobarbero = trim($_POST['apellidobarbero']);
    $emailbarbero = trim($_POST['emailbarbero']);
    $turno = trim($_POST['turno']);
    $contrasena = trim($_POST['password']);

    if ($idbarbero <= 0) die("ID inválido");

    $stmt = mysqli_prepare($conn, "UPDATE barbero SET nombrebarbero=?, apellidobarbero=?, emailbarbero=?, turno=?, contrasena=? WHERE idbarbero=?");
    mysqli_stmt_bind_param($stmt, "sssssi", $nombrebarbero, $apellidobarbero, $emailbarbero, $turno, $contrasena, $idbarbero);
    mysqli_stmt_execute($stmt);

    header("Location: ../index.php"); //Volver al listado
    exit;
}

$id = isset($_GET['idbarbero']) ? intval($_GET['idbarbero']) : 0;
if ($id <= 0) {
    die("ID de barbero inválido");
}

$sql = $conn->query("SELECT * FROM barbero WHERE idbarbero = $id");
$barbero = $sql->fetch_assoc();
if (!$barbero) {
    die("Empleado no encontrado");
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Empleado</title>
</head>
<body>
    <h2>Modificar Empleado</h2>

    <form action="modificar-empleado.php" method="post">
        
        <input type="hidden" name="idbarbero" value="<?= $barbero['idbarbero'] ?>">

        Nombre: <input type="text" name="nombrebarbero" value="<?= $barbero['nombrebarbero'] ?>" required><br>
        Apellido: <input type="text" name="apellidobarbero" value="<?= $barbero['apellidobarbero'] ?>" required><br>
        Email: <input type="email" name="emailbarbero" value="<?= $barbero['emailbarbero'] ?>" required><br>

        Turno:
        <select name="turno" required>
            <option value="Mañana" <?= $barbero['turno']=='Mañana'?'selected':'' ?>>Mañana</option>
            <option value="Tarde" <?= $barbero['turno']=='Tarde'?'selected':'' ?>>Tarde</option>
        </select><br>

        Contraseña: <input type="password" name="password" value="<?= $barbero['contrasena'] ?>" required><br>

        <button type="submit">Modificar</button>
    </form>
</body>
</html>