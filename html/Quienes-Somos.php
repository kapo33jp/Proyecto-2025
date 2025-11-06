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
<button class="menu-toggle" onclick="toggleMenu()">
    <img src="../Fotos/Moca.webp" alt="Menú">
</button>

<nav class="menu">
    <ul>
        <li><a href="Main.php">Inicio</a></li>
        <li><a href="Quienes-Somos.php">Quiénes somos</a></li>
        <li><a href="Productos.php">Productos</a></li>
    </ul>
</nav>

<header>
    <h1>Conocenos un poco mas</h1>
    <p>Transformamos tu estilo con pasión, técnica y dedicación.</p>
</header>

<section class="team">
    <div class="card">
        <img src="https://pm1.aminoapps.com/6877/fc650d83deeef454bce12f3d4a3ff4081efd4a08r1-480-471v2_hq.jpg" alt="Peluquero 1">
        <h2> Tobogan de Piojos "Alias El Peluca"</h2>
        <p>Con el peluca tenes la aerodinámica garantizada. Rendimiento +10 km/h.</p>
    </div>

    <div class="card">
        <img src="https://stickerly.pstatic.net/sticker_pack/13279e882d3a25af/8QXXWD/3/15856d78-dad8-4ad6-b7d4-4a44646fc81d-001.png" alt="Peluquero 2">
        <h2>Monica "Alias Big Mama"</h2>
        <p>Reina del barrio, patrona del fede turro.
            Si te movès, te dejo la oreja de souvenir, colta.
        </p>
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

