<?php

    session_start();
    error_reporting(0);

    $validar = $_SESSION['user_idusuario'];
    $validar = $_SESSION['user_email'];
    $validar = $_SESSION['user_idrol'];

    if ($validar == null || $validar = '') {
        header("location: ../html/login.html");
        die();
    }

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
</head>


<body>
    <!-- Iconos de redes sociales y botón de logindsds  -->
    <div class="social-icons">
        <a href="https://www.instagram.com/moca_hairstudio/" target="_blank" aria-label="Instagram">
            <img src="https://cdn-icons-png.flaticon.com/512/733/733558.png" alt="Instagram" />
        </a>
        <div class="login-box" onclick="openModal()">
            <span>Iniciar / Registrarse</span>
        </div>
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
        </ul>
    </nav>


    <!-- Contenido principal -->
    <main class="contenido">
        <h1>MOCA-hairstudio</h1>
    </main>

    <eslogan class="Eslogan">

    </eslogan>


    <!-- Modal de registro/login -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Inicio de Sesion</h2>
            <form action="../php/Login.php" method="POST">
                <!-- Campo de email -->
                <input type="email" id="email" name="email" required placeholder="Email" /><br /><br />
                <!-- Campo de contraseña -->
                <input type="password" id="password" name="password" required placeholder="Contraseña"  /><br /><br />
                <!-- Checkbox de recordarme -->
                <div class="Recordarme">
                    <input type="checkbox" id="Recordarme" name="Recordarme">
                    <p>Recordarme</p>
                </div>
                <br /><br />


                <!-- Botón de Inicio de sesion -->
                <button type="submit">Iniciar Sesion</button>
            </form>
            <existente>¿No tienes una cuenta? <a href="Registro.html">Registrate</a></existente>
        </div>
    </div>


    <!-- Scripts para interacción de menú y modal -->
    <script>
        // Abre o cierra el menú lateral
        function toggleMenu() {
            const menu = document.querySelector('.menu');
            menu.classList.toggle('activo');
        }

        // Abre el modal de login/registro
        function openModal() {
            document.getElementById("modal").style.display = "block";
        }

        // Cierra el modal de login/registro
        function closeModal() {
            document.getElementById("modal").style.display = "none";
        }

        // Cierra el modal si se hace click fuera del contenido
        window.onclick = function(event) {
            const modal = document.getElementById("modal");
            if (event.target === modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>