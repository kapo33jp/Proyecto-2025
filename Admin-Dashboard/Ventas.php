<?php
session_start();
error_reporting(0);

// Validación CORREGIDA
if (!isset($_SESSION['user_idusuario']) || $_SESSION['user_idusuario'] == null || $_SESSION['user_idusuario'] == '') {
    header("location: ../html/login.html");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content=""/>
    <meta name="author" content="" />
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="sb-nav-fixed">

<!-- Barra de navegación superior -->
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Elementos a la IZQUIERDA -->
    <div class="d-flex">
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        <a class="navbar-brand ps-3" href="index.php">Home</a>
    </div>

    <!-- Elementos a la DERECHA -->
    <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="me-2 text-white small">
                    <?php echo $_SESSION['user_email']; ?>
                </span>
                <img class="rounded-circle" src="../Fotos/User-Logogo.webp" width="40" height="40" style="object-fit: cover; background-color: transparent;">
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i> Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>

<!-- Scripts necesarios para Bootstrap 5 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Panel de Control</div>
                    <a class="nav-link" href="index.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                        Usuarios
                    </a>
                    <a class="nav-link" href="Citas.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-calendar-days"></i></div>
                        Citas
                    </a>
                    <a class="nav-link" href="Proveedores.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-truck-fast"></i></div>
                        Proveedores
                    </a>
                    <a class="nav-link" href="inventario.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                        Inventario
                    </a>
                    <a class="nav-link" href="..//php/factura.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-clipboard-list"></i></i></div>
                        Factura
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <h4>Logueado como:</h4> <?php echo $_SESSION['user_email']; ?>
            </div>
        </nav>
    </div>

    <div id="layoutSidenav_content" style="margin-left: 250px; padding: 20px; padding-top: 60px;">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Ventas</h1>
                <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" style="padding-right: 30px; text-align: center;">ID Venta</th>
                                    <th scope="col">Producto</th>
                                    <th scope="col">Usuario</th> 
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Precio Unitario</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                include '../php/conexion.php';

                                $sql = $conn->query(" SELECT v.*, p.nombreproducto, u.nombre AS nombreusuario FROM ventas v JOIN producto p ON v.idproducto = p.idproducto JOIN usuarios u ON v.idusuario = u.idusuario ORDER BY v.idventa DESC ");

                                while($datos = $sql->fetch_object()) { ?>
                                <tr>
                                    <td class="text-center"><?= $datos->idventa ?></td>
                                    <td><?= $datos->nombreproducto ?></td>
                                    <td><?= $datos->nombreusuario ?></td> 
                                    <td class="text-center"><?= $datos->cantidad ?></td>
                                    <td>$<?= number_format($datos->precio, 2) ?></td>
                                    <td>$<?= number_format($datos->total, 2) ?></td>
                                    <td>
                                        <!-- BOTÓN DE FACTURA CORREGIDO -->
                                        <a href="../php/factura.php?idventa=<?= $datos->idventa ?>" 
                                        class="btn btn-small btn-dark">
                                            <i class="fa-solid fa-file-powerpoint"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>