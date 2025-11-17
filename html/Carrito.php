<?php
session_start();
error_reporting(0);

// Configuración de conexión a base de datos
$host = 'localhost';
$user = 'root';
$pass = ''; 
$db   = 'bdbarberia';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_errno) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    die("Error de conexión MySQL: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

// Validar sesión de usuario
if (!isset($_SESSION['user_idusuario']) || $_SESSION['user_idusuario'] == null) {
    header("location: ../html/login.html");
    die();
}

// Inicializar carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Eliminar producto específico del carrito
if (isset($_GET['eliminar'])) {
    $index = $_GET['eliminar'];
    unset($_SESSION['carrito'][$index]);
    $_SESSION['carrito'] = array_values($_SESSION['carrito']); // Reindexar array
    header("Location: Carrito.php");
    exit;
}

// Vaciar todo el carrito
if (isset($_GET['vaciar'])) {
    $_SESSION['carrito'] = [];
    header("Location: Carrito.php");
    exit;
}

// Procesar finalización de compra
$mensaje = "";
if (isset($_GET['finalizar'])) {
    $idusuario = $_SESSION['user_idusuario'];

    if (!empty($_SESSION['carrito'])) {
        // Preparar consultas para verificar e insertar
        $check_stmt = $conn->prepare("SELECT idproducto FROM producto WHERE idproducto = ?");
        $insert_stmt = $conn->prepare("INSERT INTO ventas (idproducto, idusuario, cantidad_producto) VALUES (?, ?, ?)");
        
        $error_ocurrido = false;
        
        // Procesar cada producto del carrito
        foreach ($_SESSION['carrito'] as $producto) {
            $idproducto = $producto['id'];
            $cantidad = $producto['cantidad'];
            
            // Verificar que el producto existe en la base de datos
            $check_stmt->bind_param("i", $idproducto);
            $check_stmt->execute();
            $result = $check_stmt->get_result();
            
            if ($result->num_rows > 0) {
                // Insertar venta con cantidad
                $insert_stmt->bind_param("iii", $idproducto, $idusuario, $cantidad);
                if (!$insert_stmt->execute()) {
                    $mensaje = "Error al registrar la venta: " . $insert_stmt->error;
                    $error_ocurrido = true;
                    break;
                }
            } else {
                $mensaje = "Error: El producto con ID $idproducto no existe.";
                $error_ocurrido = true;
                break;
            }
        }
        
        $check_stmt->close();
        $insert_stmt->close();
        
        // Si no hubo errores, vaciar carrito y mostrar mensaje de éxito
        if (!$error_ocurrido && empty($mensaje)) {
            $_SESSION['carrito'] = [];
            $mensaje = "¡Compra finalizada con éxito!";
        }
    } else {
        $mensaje = "El carrito está vacío.";
    }
}

// Calcular total del carrito
$total = 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito - MOCA-hairstudio</title>
    <link rel="stylesheet" href="../Estilos/Carrito.css">
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

    <!-- Botón para mostrar/ocultar menú -->
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

    <!-- Contenedor principal del carrito -->
    <div class="carrito-container">
        <h1>Tu Carrito</h1>

        <!-- Mostrar mensajes de éxito o error -->
        <?php if (!empty($mensaje)): ?>
            <p class="mensaje"><?php echo $mensaje; ?></p>
        <?php endif; ?>

        <!-- Carrito vacío -->
        <?php if (empty($_SESSION['carrito'])): ?>
            <p>Tu carrito está vacío.</p>
        <?php else: ?>

            <!-- Lista de productos en el carrito -->
            <div class="lista-carrito">
                <?php foreach ($_SESSION['carrito'] as $index => $producto):
                    $subtotal = $producto['precio'] * $producto['cantidad'];
                    $total += $subtotal;
                ?>
                    <div class="carrito-item">
                        <img src="<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>">
                        <span><?php echo $producto['nombre']; ?></span>
                        <span>Cant: <?php echo $producto['cantidad']; ?></span>
                        <span>UYU <?php echo number_format($subtotal, 2); ?></span>
                        <a href="?eliminar=<?php echo $index; ?>" class="btn-eliminar">X</a>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Total de la compra -->
            <div class="carrito-total">
                <h3>Total: UYU <?php echo number_format($total, 2); ?></h3>
            </div>

            <!-- Botones de acción -->
            <div class="carrito-botones">
                <a href="?vaciar=1" class="btn-vaciar">Vaciar carrito</a>
                <a href="..//php/factura.php" class="btn-comprar">Finalizar compra</a>
            </div>

        <?php endif; ?>
    </div>

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