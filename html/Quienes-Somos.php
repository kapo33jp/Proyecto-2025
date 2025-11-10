<?php
    session_start();
    error_reporting(0);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Quiénes Somos - MOCA-hairstudio</title>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../Estilos/Quienes-Somos.css">
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
                    <a href="#" class="user-menu-item">
                        <i class="fas fa-user fa-sm fa-fw"></i> Perfil
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
    
<button class="menu-toggle" onclick="toggleMenu()">
    <img src="../Fotos/Moca.webp" alt="Menú">
</button>

<nav class="menu">
    <ul>
            <li><a href="Main.php">Inicio</a></li>
            <li><a href="Quienes-Somos.php">Quienes somos</a></li>
            <li><a href="Productos.php">Productos</a></li>
            <li><a href="Carrito.php">Carrito</a></li>
    </ul>
</nav>

<header>
    <h1>Conocenos un poco mas  </h1>
    <p>Transformamos tu estilo con pasión, técnica y dedicación.</p>
    <p>Instagram: <a href="https://www.instagram.com/moca_hairstudio/" target="_blank" aria-label="Instagram">Moca-hairStudio</a></p>

</header>

<section class="team">
    <div class="card">
        <img src="../Fotos/peluquero1.jpg" alt="Peluquero 1">
        <h2>Luciano Garcia</h2>
        <p>Descripcion</p>
    </div>

    <div class="card">
        <img src="../Fotos/peluquero2.jpg" alt="Peluquero 2">
        <h2>Guille Capote</h2>
        <p>descripcion</p>
    </div>
</section>

<div class="frase">"En MOCA-hairstudio no solo cortamos cabello, creamos identidad."</div>

<script>
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