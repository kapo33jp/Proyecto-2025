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
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
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




        <div id="layoutSidenav_content" style="margin-left: 250px; padding: 20px; padding-top: 60px;">
            <main>
                <h2 style="margin: 25px;">Listado de Usuarios</h2>
                <div class="table-responsive">


    <div>
    <button type="button" id="boton-agregar" onclick="window.location.href='Agregar-Usuario.php'" style="margin-bottom: 15px; background-color: #007bff; color: white; border: none; padding: 10px 15px; border-radius: 5px; cursor: pointer;"> 
    <i class="fa-solid fa-user-plus"></i> Agregar Usuario</button> 
    
    </div>  
            <table class="table table-bordered">
                <thead class ="bg-gray-50">
                    <tr>

                        <th style="padding-right: 30px; text-align: center;" scope="col-">ID </th>
                        <th style="padding-right: 55px" scope="col-">Nombre</th>
                        <th style="padding-right: 55px" scope="col-">Apellido</th>
                        <th style="padding-right: 55px" scope="col-">Email</th>
                        <th style="padding-right: 55px" scope="col-">Contraseña</th>
                        <th style="padding-right: 55px" scope="col-">Rol</th>

                    </tr>
                </thead>
                <tbody>
                    

                    <?php
                    include '../php/conexion.php';

                    
                    $sql = $conn->query("SELECT u.*, r.nombrerol FROM usuarios u JOIN roles r ON u.idrol = r.idrol WHERE u.idrol IN (1, 2, 3)");
                    if (!$sql) { die("Error en la consulta: " . $conn->error); }
                    while($datos = $sql->fetch_object()) {
                    ?>

                    <tr>
                        <td class ="text-center"><?= $datos->idusuario?></td>
                        <td><?= $datos->nombre?></td>
                        <td><?= $datos->apellido?></td>
                        <td><?= $datos->email?></td>
                        <td><?= $datos->contrasena?></td>
                        <td><?= $datos->nombrerol ?? '' ?></td>

                        <td>
                            <a href="ABML-Usuarios/Modificar-Usuario.php?idusuario=<?= $datos->idusuario?>" class="btn btn-small btn-danger"><i class="fa-solid fa-pen-to-square"></i></a>

                            <form class="Baja-Usuario-Form" id="Baja-Usuario-Form" action="ABML-Usuarios/Borrar-Usuario.php" method="POST" style="display:inline;">
                                <input type="hidden" name="idusuario" value="<?= $datos->idusuario ?>" />
                                <button type="submit" class="btn btn-small btn-warning" onclick="return confirm('¿Está seguro de borrar este usuario?');">
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
                            
                            <a class="nav-link" href="..//php/factura.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-clipboard-list"></i></i></div>
                                Factura
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

