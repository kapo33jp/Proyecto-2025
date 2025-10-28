<?php

        include '../../php/conexion.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idusuario = intval($_POST['idusuario']);
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $email = trim($_POST['email']);
    $contrasena = trim($_POST['contrasena']);

    if ($idusuario <= 0) die("ID inválido");

    $stmt = mysqli_prepare($conn, "UPDATE usuarios SET nombre=?, apellido=?, email=?, contrasena=? WHERE idusuario=?");
    mysqli_stmt_bind_param($stmt, "ssssi", $nombre, $apellido, $email, $contrasena, $idusuario);
    mysqli_stmt_execute($stmt);

    header("Location: ../index.php"); //Volver al listado
    exit;
}

$id = isset($_GET['idusuario']) ? intval($_GET['idusuario']) : 0;
if ($id <= 0) {
    die("ID de usuario no valido");
}

$sql = $conn->query("SELECT * FROM usuarios WHERE idusuario = $id");
$usuarios = $sql->fetch_assoc();
if (!$usuarios) {
    die("Usuario no encontrado");
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Usuario</title>
</head>
<body>
    <h2>Modificar Usuario</h2>

    <form action="Modificar-Usuario.php" method="post">
        
        <input type="hidden" name="idusuario" value="<?= $usuarios['idusuario'] ?>">

        Nombre: <input type="text" name="nombre" value="<?= $usuarios['nombre'] ?>" required><br>
        Apellido: <input type="text" name="apellido" value="<?= $usuarios['apellido'] ?>" required><br>
        Email: <input type="email" name="email" value="<?= $usuarios['email'] ?>" required><br>
        Contraseña: <input type="password" name="password" value="<?= $barbero['contrasena'] ?>" required><br>

        <button type="submit">Modificar</button>
    </form>
</body>
</html>