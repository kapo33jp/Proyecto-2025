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

    header("Location: ../index.php");
    exit;
}

$id = isset($_GET['idusuario']) ? intval($_GET['idusuario']) : 0;
if ($id <= 0) {
    die("ID de usuario no válido");
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

    <div style="position:relative; display:inline-block;">
    <input id="contrasenaInput" type="password" name="contrasena" value= <?= htmlspecialchars($usuarios['contrasena'] ?? '') ?>" required style="padding-right:36px;">
    <button type="button" id="togglePassword" aria-label="Mostrar contraseña" title="Mostrar / Ocultar contraseña" style="position:absolute; right:6px; top:50%; transform:translateY(-50%); border:none; background:transparent; cursor:pointer; padding:4px;">
    <svg id="iconEye" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"></path>
    <circle cx="12" cy="12" r="3"></circle>
    </svg>
    </button>
    </div>
    <br /><br />
        <button type="submit">Modificar</button>
    </form>
    <script>
    (function(){
    const toggle = document.getElementById('togglePassword');
    const input = document.getElementById('contrasenaInput');
    const icon = document.getElementById('iconEye');

    toggle.addEventListener('click', function () {
    const tipo = input.getAttribute('type') === 'password' ? 'text' : 'password';
    input.setAttribute('type', tipo);

    if (tipo === 'text') {
        icon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"></path><circle cx="12" cy="12" r="3"></circle>';
    } else {
        icon.innerHTML = '<path d="M17.94 17.94A10.94 10.94 0 0 1 12 20c-7 0-11-8-11-8a20.18 20.18 0 0 1 5.06-6.06"></path><path d="M1 1l22 22"></path>';
    }
    });
    })();
    </script>

</body>
</html>
