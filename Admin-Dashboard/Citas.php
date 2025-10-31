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
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" 
        <meta name="description" content=""/>
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
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
                <h2 style="margin: 25px;">Listado de Citas</h2>
                <div class="table-responsive">

            <table class="tabla-clientes" style="padding: 20px; border-collapse: separate; border-spacing: 20px 0;">
                <thead class ="bg-gray-50">
                    <tr>

                        <th class = "p-4"style="padding-right: 30px;" scope="col-6">ID </th>
                        <th style="padding-right: 30px" scope="col-">Fecha</th>
                        <th style="padding-right: 30px" scope="col-">Hora</th>
                        <th style="padding-right: 30px" scope="col-">Servicio</th>
                        <th style="padding-right: 30px" scope="col-">Barbero</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../php/conexion.php';
                    $sql = $conn->query("SELECT * FROM cita");
                    while($datos = $sql->fetch_object()) {      
                    ?>

                    <tr>
                        <td class ="text-center"><?= $datos->idcita?></td>
                        <td><?= $datos->Fecha ?? $datos->Fecha ?? '' ?></td>
                        <td><?= $datos->Hora ?? $datos->Hora ?? '' ?></td>
                        <td><?= $datos->Servicio ?? $datos->Servicio ?? '' ?></td>
                        <td><?= $datos->Barbero ?? $datos->Barbero ?? '' ?></td>

                        <td>
                            <form class="Baja-Empleado-Form" id="Baja-Empleado-Form" action="../Admin-Dashboard/ABML-Cita/Baja-Cita.php" method="POST" style="display:inline;">
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
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-truck-fast"></i></div>
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

