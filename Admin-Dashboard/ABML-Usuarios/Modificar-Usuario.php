<?php

include '../../php/conexion.php';

// Si se envía el formulario (POST) actualiza el usuario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idusuario = intval($_POST['idusuario'] ?? 0);
    $nombre = trim($_POST['nombre'] ?? '');
    $apellido = trim($_POST['apellido'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $contrasena = trim($_POST['contrasena'] ?? '');

    if ($idusuario <= 0) {
        die("ID inválido");
    }

    // Actualizar usando sentencia preparada
    $stmt = mysqli_prepare($conn, "UPDATE usuarios SET nombre=?, apellido=?, email=?, contrasena=? WHERE idusuario=?");
    mysqli_stmt_bind_param($stmt, "ssssi", $nombre, $apellido, $email, $contrasena, $idusuario);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Redirigir al índice de usuarios
    header("Location: ../index.php");
    exit;
}

// Recuperar id desde GET y validar
$id = isset($_GET['idusuario']) ? intval($_GET['idusuario']) : 0;
if ($id <= 0) {
    die("ID de usuario no válido");
}

// Obtener datos del usuario
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
    <link rel="stylesheet" href="../css/Mod-Usuario.css">
</head>
<body>

    <!-- Formulario para modificar usuario -->
    <form action="Modificar-Usuario.php" method="post">
        <h2>Modificar Usuario</h2>

        <!-- ID oculto -->
        <input type="hidden" name="idusuario" value="<?= htmlspecialchars($usuarios['idusuario']) ?>">

        <!-- Campos del formulario (escapados para evitar XSS) -->
        Nombre:
        <input type="text" name="nombre" value="<?= htmlspecialchars($usuarios['nombre']) ?>" required>

        Apellido:
        <input type="text" name="apellido" value="<?= htmlspecialchars($usuarios['apellido']) ?>" required>

        Email:
        <input type="email" name="email" value="<?= htmlspecialchars($usuarios['email']) ?>" required>

        <!-- Campo contraseña con botón para mostrar/ocultar -->
        <div style="position:relative; display:inline-block;">
        Contraseña:
                <br>
        <input id="contrasenaInput" type="password" name="contrasena" value="<?= htmlspecialchars($usuarios['contrasena'] ?? '') ?>" required style="padding-right:36px;">

        <button type="button" id="togglePassword" aria-label="Mostrar contraseña" title="Mostrar / Ocultar contraseña" style="position:absolute; right:6px; top:50%; transform:translateY(-50%); border:none; background:transparent; cursor:pointer; padding:4px;">
                <br>
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
        // Referencias a elementos
        const toggle = document.getElementById('togglePassword');
        const input = document.getElementById('contrasenaInput');
        const icon = document.getElementById('iconEye');

        // Alterna entre mostrar/ocultar contraseña y cambia el icono
        toggle.addEventListener('click', function () {
            const tipo = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', tipo);

            if (tipo === 'text') {
                // Icono ojo con línea (ocultar)
                icon.innerHTML = '<path d="M17.94 17.94A10.94 10.94 0 0 1 12 20c-7 0-11-8-11-8a20.18 20.18 0 0 1 5.06-6.06"></path><path d="M1 1l22 22"></path>';
            } else {
                // Icono ojo abierto (mostrar)
                icon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"></path><circle cx="12" cy="12" r="3"></circle>';
            }
        });
    })();
    </script>

</body>
</html>