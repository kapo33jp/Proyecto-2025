<?php
session_start();
error_reporting(0);

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
    <title>Dashboard - Citas</title>
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

        <div id="layoutSidenav_content" style="margin-left: 250px; padding: 20px;">
<<<<<<< HEAD
            <main>
                <h2 style="margin: 25px;">Listado de Citas</h2>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="p-4" style="padding-right: 30px;" scope="col">ID</th>
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
                            $sql = $conn->query("SELECT * FROM cita");
                            while($datos = $sql->fetch_object()) {      
                            ?>
                            <tr>
                                <td class="text-center"><?= $datos->idcita?></td>
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
    </div>
=======
    <main>
        <h2 style="margin: 25px;">Listado de Citas</h2>
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
                    $sql = $conn->query("SELECT c.*, u.email as user_email FROM cita c LEFT JOIN usuarios u ON c.idusuario = u.idusuario ORDER BY c.Fecha DESC, c.Hora DESC"); 

                    while($datos = $sql->fetch_object()) {
                    ?>
                    <tr>
                        <td class="text-center"><?= $datos->idcita?></td>
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
>>>>>>> 5c069c0fe5edfb3747919a94b3186fae9970ccc7

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>