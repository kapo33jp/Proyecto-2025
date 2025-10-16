<?php

$idbarbero = $_GET['idbarbero']; 
echo $idbarbero;
$conn = mysqli_connect("localhost", "root", "", "bdbarberia");
$consulta = "SELECT * FROM barbero WHERE idbarbero = '$idbarbero'";
$resultado = mysqli_query($conn, $consulta);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body>
                <form action="../ABML-Empleado/Modificar-Empleado.php" method="post">

                <!--Campo de Nombre-->
                <input type="text" id="nombre" name="nombre" required placeholder="Nombre" /><br /><br />
                <!--Campo de Apellido-->
                <input type="text" id="apellido" name="apellido" required placeholder="Apellido" /><br /><br />
                <!--Campo de Email-->
                <input type="email" id="email" name="email" required placeholder="Email" /><br /><br />
                <!--Campo de contraseña-->
                <input type="password" id="password" name="password" required placeholder="Contraseña" /><br /><br />
                
                </div>
                <br /><br />

                <button type="submit">Registrarse</button>
            </form>
        </div>
    </div>
</body>