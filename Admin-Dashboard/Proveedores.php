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

    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'bdbarberia';

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Consulta para obtener los proveedores
    $sql = "SELECT * FROM proveedor";
    $resultado = $conn->query($sql);


    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" 
        <meta name="description" content=""/>
        <meta name="author" content="" />
        <title>Admin Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        
<body class="sb-nav-fixed">
    
    <!-- Barra de navegación superior -->
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <a class="navbar-brand ps-3" href="index.php">Home</a>

    <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-white small">
                    <?php echo $_SESSION['user_email']; ?>
                </span>
                <img class="img-logo rounded-circle" src="../Fotos/User-Logogo.webp" width="40" height="40" style="object-fit: cover; background-color: transparent;">
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Perfil
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>

    
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <a class="navbar-brand ps-3" href="index.html">Home</a>

        <div id="layoutSidenav_content" style="margin-left: 250px; padding: 20px;">
            <main>
                <h2 style="margin: 25px;">Listado de Proveedores</h2>
                <div class="table-responsive">


    <div>
    <button type="button" id="boton-empleado" onclick="window.location.href='Agregar-Proveedor.html'"> 
    <i class="fa-solid fa-user-plus"></i> Agregar Proveedor</button> 
    </div>  
            <table class="tabla-proveedores">
                <thead class ="bg-gray-50">
                    <tr>

                        <th class = "p-3"style="padding-right: 30px" scope="col-8">ID </th>
                        <th style="padding-right: 55px" scope="col-">Nombre</th>
                        <th style="padding-right: 55px" scope="col-">Email</th>
                        <th style="padding-right: 55px" scope="col-">Telefono</th>

                    </tr>
                </thead>
                <tbody>
    <?php
    if ($resultado->num_rows > 0) {
        while ($datos = $resultado->fetch_object()) {
            ?>
            <tr>
                <td class="text-center"><?= $datos->idproveedor ?></td>
                <td><?= $datos->nombreproveedor ?></td>
                <td><?= $datos->emailproveedor ?></td>
                <td><?= $datos->telefonoproveedor ?></td>
                <td>

                <a href="AMBL-Proveedor/Modificar-Proveedor.php?idproveedor=<?= $datos->idproveedor ?>" class="btn btn-small btn-danger">
                <i class="fa-solid fa-pen-to-square"></i>
                </a>


                <form class="Baja-Proveedor-Form" action="../Admin-Dashboard/AMBL-Proveedor/Baja-Proveedor.php" method="POST" style="display:inline;">
                    <input type="hidden" name="idproveedor" value="<?= $datos->idproveedor ?>" />
                    <button type="submit" class="btn btn-small btn-warning" onclick="return confirm('¿Está seguro de borrar este proveedor?');">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
        <?php
    }
} else {
        echo "<tr><td colspan='5'>No hay proveedores registrados.</td></tr>";
    }
    ?>
</tbody>

            </table>
            </div> 
            </main>
        </div>
    </div>



        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Panel de Control
                            </div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                                Usuarios
                            </a>
                            
                            <a class="nav-link" href="..//Admin-Dashboard/Citas.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-calendar-days"></i></div>
                                Citas
                            </a>
                            
                            <a class="nav-link" href="Proveedores.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-truck-fast"></i></i></div>
                                Proveedores
                            </a>
                            
                            <a class="nav-link" href="inventario.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                                Inventario
                            </a>
                            
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Autenticacion 
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.html">Iniciar Sesion</a>
                                            <a class="nav-link" href="register.html">Registrarse</a>
                                            <a class="nav-link" href="password.html">Olvidar Contrasena</a>
                                        </nav>
                                    </a>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <h4>Logueado como:</h4> <?php echo $_SESSION['user_email']; ?>
                    </div>
                </nav>
            </div>
        </div>


                
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
        </body>
</html>

