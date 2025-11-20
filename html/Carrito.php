<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


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

/* --- SUMAR y RESTAR CANTIDAD --- */
if (isset($_GET['sumar'])) {
    $index = $_GET['sumar'];
    if (isset($_SESSION['carrito'][$index])) {
        $_SESSION['carrito'][$index]['cantidad']++;
    }
    header("Location: Carrito.php");
    exit;
}

if (isset($_GET['restar'])) {
    $index = $_GET['restar'];
    if (isset($_SESSION['carrito'][$index])) {
        if ($_SESSION['carrito'][$index]['cantidad'] > 1) {
            $_SESSION['carrito'][$index]['cantidad']--;
        }
    }
    header("Location: Carrito.php");
    exit;
}

/* --- ELIMINAR PRODUCTO --- */
if (isset($_GET['eliminar'])) {
    $index = $_GET['eliminar'];
    unset($_SESSION['carrito'][$index]);
    $_SESSION['carrito'] = array_values($_SESSION['carrito']); 
    header("Location: Carrito.php");
    exit;
}

/* --- VACIAR CARRITO --- */
if (isset($_GET['vaciar'])) {
    $_SESSION['carrito'] = [];
    header("Location: Carrito.php");
    exit;
}

/* --- FINALIZAR COMPRA --- */
$mensaje = "";
if (isset($_GET['finalizar'])) {
    $idusuario = $_SESSION['user_idusuario'];

    if (!empty($_SESSION['carrito'])) {

        // Traer idproducto y PRECIO CORRECTO (precioproducto)
        $check_stmt = $conn->prepare("SELECT idproducto, precioproducto FROM producto WHERE idproducto = ?");
        $insert_stmt = $conn->prepare("INSERT INTO ventas (idproducto, idusuario, cantidad, precio, total) VALUES (?, ?, ?, ?, ?)");

        $error_ocurrido = false;

        foreach ($_SESSION['carrito'] as $producto) {
            $idproducto = $producto['id'];
            $cantidad = $producto['cantidad'];

            // Verificar existencia y obtener precio real desde la BD
            $check_stmt->bind_param("i", $idproducto);
            $check_stmt->execute();
            $result = $check_stmt->get_result();

            if ($result->num_rows > 0) {
                $producto_db = $result->fetch_assoc();
                $precio_unitario = (float)$producto_db['precioproducto'];
                $total_producto = $precio_unitario * $cantidad;

                // Insertar venta
                $insert_stmt->bind_param("iiiid", 
                    $idproducto, 
                    $idusuario, 
                    $cantidad, 
                    $precio_unitario, 
                    $total_producto
                );

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

        if (!$error_ocurrido && empty($mensaje)) {
            $_SESSION['carrito'] = [];
            $mensaje = "¡Compra finalizada con éxito!";
        }

    } else {
        $mensaje = "El carrito está vacío.";
    }
}



// Calcular total
$total = 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito - MOCA-hairstudio</title>
    <link rel="stylesheet" href="../Estilos/Carrito1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .cantidad-control {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .btn-cant {
            padding: 4px 10px;
            background: #ddd;
            border-radius: 5px;
            text-decoration: none;
            color: black;
            font-size: 18px;
            font-weight: bold;
        }
        .btn-cant:hover {
            background: #bbb;
        }
    </style>
</head>

<body>

    <!-- Iconos y usuario -->
    <div class="social-icons">

        <?php if(isset($_SESSION['user_email'])): ?>
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

    <!-- Botón menú -->
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

    <div class="carrito-container">
        <h1>Tu Carrito</h1>

        <?php if (!empty($mensaje)): ?>
            <p class="mensaje"><?php echo $mensaje; ?></p>
        <?php endif; ?>

        <?php if (empty($_SESSION['carrito'])): ?>
            <p>Tu carrito está vacío.</p>
        <?php else: ?>

            <div class="lista-carrito">
                <?php foreach ($_SESSION['carrito'] as $index => $producto):
                    $subtotal = $producto['precio'] * $producto['cantidad'];
                    $total += $subtotal;
                ?>
                    <div class="carrito-item">
                        <img src="<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>">
                        <span><?php echo $producto['nombre']; ?></span>

                        <div class="cantidad-control">
                            <a href="?restar=<?php echo $index; ?>" class="btn-cant">−</a>
                            <span><?php echo $producto['cantidad']; ?></span>
                            <a href="?sumar=<?php echo $index; ?>" class="btn-cant">+</a>
                        </div>

                        <span>UYU <?php echo number_format($subtotal, 2); ?></span>
                        <a href="?eliminar=<?php echo $index; ?>" class="btn-eliminar">X</a>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="carrito-total">
                <h3>Total: UYU <?php echo number_format($total, 2); ?></h3>
            </div>

            <div class="carrito-botones">
                <a href="?vaciar=1" class="btn-vaciar">Vaciar carrito</a>
                <a href="?finalizar=1" class="btn-comprar">Finalizar compra</a>
            </div>

        <?php endif; ?>
    </div>

<script>
function toggleMenu() {
    const menu = document.querySelector('.menu');
    menu.classList.toggle('activo');
}

function toggleUserMenu() {
    const userMenu = document.getElementById('userMenu');
    userMenu.classList.toggle('activo');
}

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
