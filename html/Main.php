<?php
    session_start();
    error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MOCA-hairstudio</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Poppins:wght@300;400;600&family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../Estilos/Main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Edu+SA+Hand:wght@400..700&family=Lexend+Mega:wght@100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Quantico:ital,wght@0,400;0,700;1,400;1,700&family=Roboto:ital,wght@0,100..900;1,100..900&family=Ropa+Sans:ital@0;1&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Edu+SA+Hand:wght@400..700&family=Lexend+Mega:wght@100..900&family=Meow+Script&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Quantico:ital,wght@0,400;0,700;1,400;1,700&family=Roboto:ital,wght@0,100..900;1,100..900&family=Ropa+Sans:ital@0;1&display=swap" rel="stylesheet">
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
                    <a href="../html/Citas-Usuario.php" class="user-menu-item">
                        <i class="fas fa-user fa-sm fa-fw"></i> Citas
                    </a>

                    <div class="user-menu-divider"></div>
                    <a href="../php/logout.php" class="user-menu-item">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw"></i> Cerrar Sesión
                    </a>

                </div>
            </div>
        <?php else: ?>
            <!-- Mostrar botón de login si no hay sesión -->
            <a class="login-box" href="login.html">
                <span>Iniciar / Registrarse</span>
            </a>
        <?php endif; ?>
    </div>

    <!-- Botón de reserva -->
    <button class="reserva-btn" onclick="window.location.href='Reserva.php'">
        <p>Reservar</p> 
    </button>

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

    <!-- Contenido principal -->
    <main class="contenido">
        <h1>MOCA-hairstudios</h1>
    </main>

    <eslogan class="Eslogan">
        <!-- Tu eslogan aquí -->
    </eslogan>

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