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
    <title>Productos - MOCA-hairstudio</title>
    <link rel="stylesheet" href="../Estilos/Productos.css"> <!-- solo productos -->
</head>
<body class="productos"> 

    <!-- Botón para abrir/cerrar el menú lateral pepe-->
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

    <!-- Contenido principal sss -->
    <main class="contenido">
    <h1>Nuestros Productos</h1>
    <div class="productos-grid">
        <div class="producto">
            <img src="../Fotos/Cera4.jpg" alt="Cera 4">
            <h2>Cera 4</h2>
            <p>UYU 500.00</p>
            <div class="carrito-box">
                <button class="agregar-carrito">Agregar al carrito</button>
            </div>
        </div>
        <div class="producto">
            <img src="../Fotos/CERAENPOLVO.jpg" alt="Cera en Polvo">
            <h2>Cera en Polvo</h2>
            <p>UYU 600.00</p>
            <div class="carrito-box">
                <button class="agregar-carrito">Agregar al carrito</button>
            </div>
        </div>
        <div class="producto">
            <img src="../Fotos/CERAMATTEWAX.jpg" alt="Cera Matte Wax">
            <h2>Cera Matte Wax</h2>
            <p>UYU 500.00</p>
            <div class="carrito-box">
                <button class="agregar-carrito">Agregar al carrito</button>
            </div>
        </div>
        <div class="producto">
            <img src="../Fotos/OLEOPARABARBA.jpg" alt="Oleo para Barba">
            <h2>Oleo para Barba</h2>
            <p>UYU 450.00</p>
            <div class="carrito-box">
                <button class="agregar-carrito">Agregar al carrito</button>
            </div>
        </div>
    </div>
</main>

    <!-- Script para desplegar el menú -->
    <script>
        function toggleMenu() {
            const menu = document.querySelector('.menu');
            menu.classList.toggle('activo');
        }
    </script>

</body>
</html>