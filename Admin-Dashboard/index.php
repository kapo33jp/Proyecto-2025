<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<<<<<<< HEAD
        
<body class="sb-nav-fixed">
    <!-- Barra superior -->
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle"><i class="fas fa-bars"></i></button>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Buscar..." />
                <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Configuraciones</a></li>
                    <li><a class="dropdown-item" href="#!">Registro de Actividades</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item" href="#!">Cerrar sesión</a></li>
                </ul>
            </li>
        </ul>
    </nav>




        <div id="layoutSidenav_content" style="margin-left: 250px; padding: 20px;">
            <main>
                <h2>Listado de Usuarios</h2>
                <div class="table-responsive">

=======
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Configuraciones</a></li>
                        <li><a class="dropdown-item" href="#!">Registro de Actividades</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Cerrar sesion</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        </div>

        <div class="container-fluid">
            <div class="col-8 p-4"> ">
>>>>>>> 973a6d3a061e42981b253bda59e81c9803c4dfd9
            <table class="tabla-clientes">
                <thead class ="bg-gray-50">
                    <tr>
<<<<<<< HEAD

                        <th class = "p-3"style="padding-right: 30px" scope="col-8">ID </th>
                        <th style="padding-right: 30px" scope="col-">Nombre</th>
                        <th style="padding-right: 30px" scope="col-">Apellido</th>
                        <th style="padding-right: 30px" scope="col-">Email</th>
                        <th style="padding-right: 30px" scope="col-">Turno</th>
                        <th style="padding-right: 30px" scope="col-">Contraseña</th>

=======
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Turno</th>
                        <
>>>>>>> 973a6d3a061e42981b253bda59e81c9803c4dfd9
                    </tr>
                </thead>
                <tbody>
                    

                    <?php
                    include '../php/conexion.php';
                    $sql = $conn->query("SELECT * FROM barbero");
                    while($datos = $sql->fetch_object()) {      ?>

                    <tr>
<<<<<<< HEAD
                        <td class ="text-center"><?= $datos->idbarbero?></td>
                        <td><?= $datos->nombrebarbero?></td>
                        <td><?= $datos->apellidobarbero?></td>
                        <td><?= $datos->email?></td>
                        <td><?= $datos->turno?></td>
                        <td><?= $datos->contrasena?></td>

                        <td>
                            <a href="" class= "btn btn-small btn-danger"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="" class= "btn btn-small btn-warning"><i class="fa-solid fa-trash"></i></a>   
                        </td>
                    </tr>
                    <?php } ?>
            </tbody>
=======
                        <td>Juan</td>
                        <td>Perez</td>
                        <td>juanperez@gmail.com</td>
                        <td>10:00 - 20:00</td>
                    </tr>
                </tbody>
                    <?php
                    include '../php/conexion.php';
                    $sql = $conn->query("SELECT * FROM barbero");
                    while($datos = $sql->fetch_object()) {      ?>

                    <tr>

                        <td> <?= $datos->idbarbero?></td>
                        <td> <?= $datos->nombrebarbero?></td>
                        <td> <?= $datos->apellidobarbero?></td>
                        <td> <?= $datos->email?></td>
                        <td> <?= $datos->turno?></td>
                        <td> <?= $datos->contrasena?></td>

                        <td>
                            <a href="editar.php?id=<?= $datos->idcliente?>" class="btn btn-small btn-warning">Editar</a>
                            <a href="eliminar.php?id=<?= $datos->idcliente?>" class="btn btn-small btn-danger">Eliminar</a>   
                        </td>
                    </tr>
                    <?php } ?>
>>>>>>> 973a6d3a061e42981b253bda59e81c9803c4dfd9
                    
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
                            <div class="sb-sidenav-menu-heading">Nucleo</div>
                            <a class="nav-link" href="index.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Admin panel
                            </a>
                            
                            <div class="sb-sidenav-menu-heading">Interfaz</div>
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
                            <div class="sb-sidenav-menu-heading">Addons</div>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
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
<<<<<<< HEAD
        </body>
=======
    </body>
>>>>>>> 973a6d3a061e42981b253bda59e81c9803c4dfd9
</html>

