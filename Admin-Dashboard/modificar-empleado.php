<?php

$idbarbero = $_GET["idbarbero"];
$conn = mysqli_connect("localhost","root","","bdbarberia");
$consulta = "SELECT * FROM barbero WHERE idbarbero = $idbarbero";
$resultado = mysqli_query($conn, $consulta);
$barbero = mysqli_fetch_array($resultado);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Modificar Empleado</title>
    <link rel="stylesheet" href="../Estilos/Reg-Empleado-Style.css ">
</head>
<body>
    <!-- Página de Registro -->
    <div class="modal" style="display: block;">
        <div class="modal-content">
            <a  class="close" aria-label="Cerrar">&times;</a>
            <h2>Modificar</h2>
            <form action="../Admin-Dashboard/ABML-Empleado/Modificar-Empleado.php" method="post">

                <!--Campo de Nombre-->
                <input type="text" id="nombre" name="nombre" required placeholder="Nombre" value="<?php echo $barbero['nombre_barbero'] ?? ''; ?>" />
                <!--Campo de Apellido-->
                <input type="text" id="apellido" name="apellido" required placeholder="Apellido" value="<?php echo $barbero['apellido_barbero'] ?? ''; ?>" />
                <!--Campo de Email-->
                <input type="email" id="email" name="email" required placeholder="Email" value="<?php echo $barbero['email_barbero'] ?? ''; ?>" />
                <!--Campo de Turno-->
                <div>
                    <select id="turno" name="turno" required>
                        <option value="" disabled selected> turno</option>
                        <option value="Mañana">Mañana</option>
                        <option value="Tarde">Tarde</option>    
                    </select>
                </div>
                <br />
                <!--Campo de contraseña-->
                <input type="password" id="password" name="password" required placeholder="Contraseña" value="<?php echo $barbero['contrasena'] ?? ''; ?>" />

                <button type="submit" name="btnempleado">Modificar</button>
            </form>
        </div>
    </div>

</body>
</html>