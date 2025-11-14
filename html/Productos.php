<?php
session_start();
error_reporting(0);

// Inicializar carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Procesar agregar producto al carrito
if (isset($_POST['nombre'])) {
    // Solo permitir agregar al carrito si el usuario está logueado
    if (isset($_SESSION['user_email'])) {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $imagen = $_POST['imagen'];

        // Buscar si el producto ya está en el carrito
        $existe = false;
        foreach ($_SESSION['carrito'] as &$item) {
            if ($item['id'] === $id) {
                $item['cantidad']++;  // Incrementar cantidad si ya existe
                $existe = true;
                break;
            }
        }

        // Agregar nuevo producto si no existe
        if (!$existe) {
            $_SESSION['carrito'][] = [
                'id' => $id,
                'nombre' => $nombre,
                'precio' => $precio,
                'imagen' => $imagen,
                'cantidad' => 1
            ];
        }
    }

    // Redirigir para evitar reenvío del formulario
    header("Location: Productos.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - MOCA-hairstudio</title>
    <link rel="stylesheet" href="../Estilos/Productos.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="productos"> 

<!-- Barra de redes sociales y login -->
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
    <?php else: ?>
        <!-- Mostrar botón de login si no hay sesión -->
        <a class="login-box" href="login.html">
            <span>Iniciar / Registrarse</span>
        </a>
    <?php endif; ?>
</div>

<!-- Botón para abrir/cerrar menú -->
<button class="menu-toggle" onclick="toggleMenu()">
    <img src="../Fotos/Moca.webp" alt="Menú">
</button>

<!-- Menú de navegación -->
<nav class="menu">
    <ul>
        <li><a href="Main.php">Inicio</a></li>
        <li><a href="Quienes-Somos.php">Quienes somos</a></li>
        <li><a href="Productos.php">Productos</a></li>
        <li><a href="Carrito.php">Carrito</a></li>
    </ul>
</nav>

<!-- Lista de productos -->
<main class="contenido">
    <h1>Nuestros Productos</h1>

    <div class="productos-grid">
        <!-- Producto 1: Pasta Capilar -->
        <div class="producto">
            <img src="../Fotos/Cera4.jpg" alt="Cera 4">
            <h2>Pasta Capilar</h2>
            <p>UYU 500.00</p>
            <div class="carrito-box">
                <?php if(isset($_SESSION['user_email'])): ?>
                    <form method="post" action="">
                        <input type="hidden" name="id" value="8">
                        <input type="hidden" name="nombre" value="Pasta Capilar">
                        <input type="hidden" name="precio" value="500">
                        <input type="hidden" name="imagen" value="../Fotos/Cera4.jpg">
                        <button type="submit" class="agregar-carrito">Agregar al carrito</button>
                    </form>
                <?php else: ?>
                    <button class="agregar-carrito" onclick="alert('Debes iniciar sesión para agregar productos al carrito')">Agregar al carrito</button>
                <?php endif; ?>
            </div>
        </div>

        <!-- Producto 2: Cera en Polvo -->
        <div class="producto">
            <img src="../Fotos/CERAENPOLVO.jpg" alt="Cera en Polvo">
            <h2>Cera en Polvo</h2>
            <p>UYU 600.00</p>
            <div class="carrito-box">
                <?php if(isset($_SESSION['user_email'])): ?>
                    <form method="post" action="">
                        <input type="hidden" name="id" value="9">
                        <input type="hidden" name="nombre" value="Cera en Polvo">
                        <input type="hidden" name="precio" value="600">
                        <input type="hidden" name="imagen" value="../Fotos/CERAENPOLVO.jpg">
                        <button type="submit" class="agregar-carrito">Agregar al carrito</button>
                    </form>
                <?php else: ?>
                    <button class="agregar-carrito" onclick="alert('Debes iniciar sesión para agregar productos al carrito')">Agregar al carrito</button>
                <?php endif; ?>
            </div>
        </div>

        <!-- Producto 3: Cera Matte Wax -->
        <div class="producto">
            <img src="../Fotos/CERAMATTEWAX.jpg" alt="Cera Matte Wax">
            <h2>Cera Matte Wax</h2>
            <p>UYU 500.00</p>
            <div class="carrito-box">
                <?php if(isset($_SESSION['user_email'])): ?>
                    <form method="post" action="">
                        <input type="hidden" name="id" value="10">
                        <input type="hidden" name="nombre" value="Cera Matte Wax">
                        <input type="hidden" name="precio" value="500">
                        <input type="hidden" name="imagen" value="../Fotos/CERAMATTEWAX.jpg">
                        <button type="submit" class="agregar-carrito">Agregar al carrito</button>
                    </form>
                <?php else: ?>
                    <button class="agregar-carrito" onclick="alert('Debes iniciar sesión para agregar productos al carrito')">Agregar al carrito</button>
                <?php endif; ?>
            </div>
        </div>

        <!-- Producto 4: Oleo para Barba -->
        <div class="producto">
            <img src="../Fotos/OLEOPARABARBA.jpg" alt="Oleo para Barba">
            <h2>Oleo para Barba</h2>
            <p>UYU 450.00</p>
            <div class="carrito-box">
                <?php if(isset($_SESSION['user_email'])): ?>
                    <form method="post" action="">
                        <input type="hidden" name="id" value="11">
                        <input type="hidden" name="nombre" value="Oleo para Barba">
                        <input type="hidden" name="precio" value="450">
                        <input type="hidden" name="imagen" value="../Fotos/OLEOPARABARBA.jpg">
                        <button type="submit" class="agregar-carrito">Agregar al carrito</button>
                    </form>
                <?php else: ?>
                    <button class="agregar-carrito" onclick="alert('Debes iniciar sesión para agregar productos al carrito')">Agregar al carrito</button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<!-- Script para controlar el menú -->
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