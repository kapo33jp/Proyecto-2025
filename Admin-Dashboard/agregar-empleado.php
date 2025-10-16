<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Agregar Empleado</title>
    <link rel="stylesheet" href="../Estilos/Reg-Empleado-Style.css ">
</head>
<body>


<?php
include "../php/conexion.php";
include "../ABML-Empleado/Alta-Empleado.php";
?>
    <!-- Página de Registro -->
    <div class="modal" style="display: block;">
        <div class="modal-content">
            <a  class="close" aria-label="Cerrar">&times;</a>
            <h2>Registro</h2>
            <form action="../ABML-Empleado/Alta-Empleado.php" method="post">

                <!--Campo de Nombre-->
                <input type="text" id="nombre" name="nombre" required placeholder="Nombre" /><br /><br />
                <!--Campo de Apellido-->
                <input type="text" id="apellido" name="apellido" required placeholder="Apellido" /><br /><br />
                <!--Campo de Email-->
                <input type="email" id="email" name="email" required placeholder="Email" /><br /><br />
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
                <input type="password" id="password" name="password" required placeholder="Contraseña" /><br /><br />
                </div>
                <br /><br />

                <button type="submit" name="btnempleado">Registrarse</button>
            </form>
        </div>
    </div>

</body>
</html>