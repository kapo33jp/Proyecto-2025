<?php
    session_start();
    error_reporting(0);

    // Si no está logueado, lo mandamos al login
    if (!isset($_SESSION['user_idusuario'])) {
        header("location: login.html");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Citas - MOCA-hairstudio</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Poppins:wght@300;400;600&family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../Estilos/Main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Edu+SA+Hand:wght@400..700&family=Lexend+Mega:wght@100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Quantico:ital,wght@0,400;0,700;1,400;1,700&family=Roboto:ital,wght@0,100..900;1,100..900&family=Ropa+Sans:ital@0;1&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Edu+SA+Hand:wght@400..700&family=Lexend+Mega:wght@100..900&family=Meow+Script&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Quantico:ital,wght@0,400;0,700;1,400;1,700&family=Roboto:ital,wght@0,100..900;1,100..900&family=Ropa+Sans:ital@0;1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Iconos de redes sociales y usuario logueado -->
    <div class="social-icons">
        
        <?php if(isset($_SESSION['user_email'])): ?>
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

    <div id="layoutSidenav_content" style="margin-top: 270px; margin-left: 100px; margin-right: 100px; padding: 20px; background-color: #f8f9fa; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
    <main>
        <h2 style=" margin-right: 50px">Mis Citas</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="bg-gray-50">
                    <tr>
                        <th style="padding-right: 30px; text-align: center;" scope="col">ID</th>
                        <th style="padding-right: 30px" scope="col">Cliente</th>
                        <th style="padding-right: 30px" scope="col">Fecha</th>
                        <th style="padding-right: 30px" scope="col">Hora</th>
                        <th style="padding-right: 30px" scope="col">Servicio</th>
                        <th style="padding-right: 30px" scope="col">Barbero</th>
                        <th style="padding-right: 30px" scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../php/conexion.php';

                    // ID del usuario logueado
                    $idUser = $_SESSION['user_idusuario'];

                    // Traer solo citas del usuario actual
                    $sql = $conn->query(" SELECT c.*, u.email AS user_email FROM cita c LEFT JOIN usuarios u ON c.idusuario = u.idusuario WHERE c.idusuario = ' $idUser 'ORDER BY c.Fecha DESC, c.Hora DESC ");

                    while($datos = $sql->fetch_object()) {
                    ?>
                    <tr>
                        <td class="text-center"><?= $datos->idcita ?></td>
                        <td><?= $datos->user_email ?? 'No asignado' ?></td>
                        <td><?= $datos->Fecha ?? '' ?></td>
                        <td><?= $datos->Hora ?? '' ?></td>
                        <td><?= $datos->Servicio ?? '' ?></td>
                        <td><?= $datos->Barbero ?? '' ?></td>
                        <td>
                            <form class="Baja-Empleado-Form" action="../Admin-Dashboard/ABML-Cita/Baja-Cita.php" method="POST" style="display:inline;">
                                <input type="hidden" name="idcita" value="<?= $datos->idcita ?>" />
                                <button type="submit" class="btn btn-small btn-warning" onclick="return confirm('¿Está seguro de cancelar esta cita?');">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div> 
    </main>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
