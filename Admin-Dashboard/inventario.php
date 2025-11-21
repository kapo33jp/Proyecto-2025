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
        <a class="navbar-brand ps-3">Moca-HairStudio Management</a>
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
                <li><a class="dropdown-item" href="#"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i> Perfil</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i> Logout</a></li>
            </ul>
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
        </nav>
    </div>

    <div id="layoutSidenav_content" style="margin-left: 250px; padding: 20px; padding-top: 60px;">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Inventario Disponible</h1>
                <div class="table-responsive">
                    <div>
                        <button type="button" id="boton-agregar" onclick="window.location.href='Agregar-Producto-Form.php'" style="margin-bottom: 15px; background-color: #007bff; color: white; border: none; padding: 10px 15px; border-radius: 5px; cursor: pointer;">
                            <i class="fa-solid fa-square-plus"></i> Agregar Items
                        </button>
                    </div>
                    <table class="table table-bordered">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" style="padding-right: 30px; text-align: center;">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Proveedor</th>
                                <th scope="col">Imagen</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include '../php/conexion.php';
                            $sql = $conn->query("SELECT producto.*, proveedor.nombreproveedor FROM producto JOIN proveedor ON producto.idproveedor = proveedor.idproveedor");
                            while($datos = $sql->fetch_object()) { ?>
                            <tr>
                                <td class="text-center"><?= $datos->idproducto ?></td>
                                <td><?= $datos->nombreproducto ?></td>
                                <td><?= $datos->precioproducto ?></td>
                                <td><?= $datos->tipoproducto ?></td>
                                <td><?= $datos->nombreproveedor ?></td>
                                <td>
                                    <?php if ($datos->imagenproducto): ?>
                                        <img src="data:image/jpeg;base64,<?= base64_encode($datos->imagenproducto) ?>" alt="Imagen del producto" style="width: 100px; height: auto;" />
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="ABML-Producto/Modificar-Producto.php?idproducto=<?= $datos->idproducto?>" class="btn btn-small btn-danger">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form class="Baja-Producto-Form" action="ABML-Producto/Baja-Producto.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="idproducto" value="<?= $datos->idproducto ?>" />
                                        <button type="submit" class="btn btn-small btn-warning" onclick="return confirm('¿Está seguro de borrar este producto?');">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
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