<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Agregar Usuario</title>
    <link rel="stylesheet" href="">
</head>
<body>
    <!-- Página de Registro -->
    <div class="modal" style="display: block;">
        <div class="modal-content">
            <a class="close" aria-label="Cerrar">&times;</a>
            <h2>Registro</h2>

            <form action="ABML-Usuarios/Alta-Usuario.php" method="post">
                <!--Campo de Nombre-->
                <input type="text" id="nombre" name="nombre" required placeholder="Nombre" /><br /><br />

                <!--Campo de Apellido-->
                <input type="text" id="apellido" name="apellido" required placeholder="Apellido" /><br /><br />

                <!--Campo de Email-->
                <input type="email" id="email" name="email" required placeholder="Email" /><br /><br />

                <!--Campo de Contraseña-->
                <div style="position:relative; display:inline-block;">
                <input id="contrasenaInput" type="password" name="contrasena" value="<?= htmlspecialchars($usuarios['contrasena'] ?? '') ?>" required style="padding-right:36px;" placeholder="Contraseña">
                <button type="button" id="togglePassword" aria-label="Mostrar contraseña" title="Mostrar / Ocultar contraseña" style="position:absolute; right:6px; top:50%; transform:translateY(-50%); border:none; background:transparent; cursor:pointer; padding:4px;">
                <svg id="iconEye" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"></path>
                <circle cx="12" cy="12" r="3"></circle>
                </svg>
                </button>
                </div>
                <br /><br />

                <!--Campo de Rol-->
                <label for="idrol">Rol:</label>
                <select class="form-select" id="idrol" name="idrol" required>
                    <option value="1">Admin</option>
                    <option value="2" selected>Empleado</option>
                    <option value="3">Cliente</option>
                </select>
                <br /><br />

                <button type="submit" name="btnusuario">Registrar</button>
            </form>
        </div>
    </div>

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
