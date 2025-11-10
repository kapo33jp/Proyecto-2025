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
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Quiénes Somos - MOCA-hairstudio</title>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../Estilos/Quienes-Somos.css">
</head>

<body>

    <!-- Iconos de redes sociales y botón de logindsds  -->
    <div class="social-icons">
        <a href="https://www.instagram.com/moca_hairstudio/" target="_blank" aria-label="Instagram">
            <img src="https://cdn-icons-png.flaticon.com/512/733/733558.png" alt="Instagram" />
        </a>
        <a class="login-box" href="login.html">
            <span>Iniciar / Registrarse</span>
        </a>
    </div>
    
<button class="menu-toggle" onclick="toggleMenu()">
    <img src="../Fotos/Moca.webp" alt="Menú">
</button>

<nav class="menu">
    <ul>
        <li><a href="Main.php">Inicio</a></li>
        <li><a href="Quienes-Somos.php">Quiénes somoss</a></li>
        <li><a href="Productos.php">Productos</a></li>
    </ul>
</nav>

<header>
    <h1>Conocenos un poco mas</h1>
    <p>Transformamos tu estilo con pasión, técnica y dedicación.</p>
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

<div class="frase">“En MOCA-hairstudio no solo cortamos cabello, creamos identidad.”</div>

<script>
function toggleMenu() {
    const menu = document.querySelector('.menu');
    menu.classList.toggle('activo');
}
</script>
</body>
</html>

