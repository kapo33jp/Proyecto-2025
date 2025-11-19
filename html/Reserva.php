<?php
    session_start();
    error_reporting(0);

    $validar = $_SESSION['user_idusuario'];
    $validar_email = $_SESSION['user_email'];
    $validar_rol = $_SESSION['user_idrol'];

    if ($validar == null || $validar == '') {
        header("location: ../html/login.html");
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva</title>
    <link rel="stylesheet" href="../Estilos/Reserva.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <!-- Iconos de redes sociales y usuario logueado -->
    <div class="social-icons">
        
        <?php if(isset($_SESSION['user_email'])): ?>
            <!-- Mostrar usuario logueado -->
            <div class="user-dropdown">
                <div class="user-toggle" onclick="toggleUserMenu()">
                    <span class="user-email"><?php echo $_SESSION['user_email']; ?></span>
                    <img class="user-img" src="../Fotos/User-Logogo.webp" alt="Usuario">
                </div>
                <div class="user-menu" id="userMenu">
                    <a href="Citas-Usuario.php" class="user-menu-item">
                        <i class="fas fa-user fa-sm fa-fw"></i> Citas
                    </a>
                    <div class="user-menu-divider"></div>
                    <a href="../php/logout.php" class="user-menu-item">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw"></i> Cerrar Sesión
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>

        <!-- Botón para abrir/cerrar el menú lateral -->
    <button class="menu-toggle" onclick="toggleMenu()">
        <img src="../Fotos/Moca.webp" alt="Menú">
    </button>

    <!-- Menú lateral de navegación -->
    <nav class="menu">
        <ul>
            <li><a href="Main.php">Inicio</a></li>
            <li><a href="Quienes-Somos.php">Quienes somos</a></li>
            <li><a href="Productos.php">Productos</a></li>
            <li><a href="Carrito.php">Carrito</a></li>
        </ul>
    </nav>

<Form action="../Admin-Dashboard/ABML-Cita/Alta-Cita.php" method="post">
    <div class="reserva-box" id="reserva-box">
        <li>
            <h1>Reserva tu cita</h1>
        </li>
        <!-- Campo oculto para el idusuario -->
        <input type="hidden" name="idusuario" value="<?php echo $_SESSION['user_idusuario']; ?>">
        
        <li>
            <label for="Fecha">Fecha:</label>
            <input type="date" id="Fecha" name="Fecha" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+14 days')); ?>" required>
        </li>
        <li>
            <label for="Hora">Hora:</label>
            <select id="Hora" name="Hora" required>
                <option value="">Selecciona una hora</option>
                <option value="10:00">10:00</option>
                <option value="10:45">10:45</option>
                <option value="11:30">11:30</option>
                <option value="12:15">12:15</option>
                <option value="15:15">15:15</option>
                <option value="16:00">16:00</option>
                <option value="16:45">16:45</option>
                <option value="17:30">17:30</option>
                <option value="18:15">18:15</option>
                <option value="19:00">19:00</option>
            </select>
        </li>
        <li>
            <label for="Servicio">Servicio:</label>
            <select id="Servicio" name="Servicio" required>
                <option value="">Selecciona un servicio</option>
                <option value="Corte">Corte de cabello $400</option>
                <option value="Ceja">Corte de ceja $50</option>
                <option value="Barba">Barba $200</option>
            </select>
        </li>
        <li>
            <label for="Barbero">Barbero:</label>
            <select id="Barbero" name="Barbero" required>
                <option value="">Selecciona un barbero</option>
                <option value="Guillermo">Guille Capote</option>
                <option value="Luciano">Luciano Garcia</option>
            </select>
        </li>
        <li>
            <button class="boton-reserva" id="boton-reserva" name="Btn-Reserva" type="submit">Reservar</button>
        </li>
        <br> </br>
        <plinea>----------------------------------------------------------------</plinea>
        <li class="info-box" id="info-box">
            <h2>Horario de Atencion</h2>
            <p>Lunes a Sabado 10:00 - 19:00</p>
            <p>Domingo: Cerrado</p>
        </li>
    </div>
</Form>

    <script>
    // Abre o cierra el menú de usuario
    function toggleUserMenu() {
        const userMenu = document.getElementById('userMenu');
        userMenu.classList.toggle('activo');
    }

    // Cierra el menú de usuario si se hace click fuera de él
    document.addEventListener('click', function(event) {
        const userDropdown = document.querySelector('.user-dropdown');
        const userMenu = document.getElementById('userMenu');
        
        if (userDropdown && !userDropdown.contains(event.target)) {
            userMenu.classList.remove('activo');
        }
    });
    </script>

        <!-- Scripts para interacción de menú -->
        
    <script>
        // Abre o cierra el menú lateral
        function toggleMenu() {
            const menu = document.querySelector('.menu');
            menu.classList.toggle('activo');
        }

        // Abre o cierra el menú de usuario
        function toggleUserMenu() {
            const userMenu = document.getElementById('userMenu');
            userMenu.classList.toggle('activo');
        }

        // Cierra el menú de usuario si se hace click fuera de él
        document.addEventListener('click', function(event) {
            const userDropdown = document.querySelector('.user-dropdown');
            const userMenu = document.getElementById('userMenu');
            
            if (userDropdown && !userDropdown.contains(event.target)) {
                userMenu.classList.remove('activo');
            }
        });
    </script>
</body>
</html>