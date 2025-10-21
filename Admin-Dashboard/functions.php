<?php

    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db   = 'bdbarberia';

    $conn = mysqli_connect($host, $user, $pass, $db);

    if (!$conn) {
        error_log('Error de conexión MySQL: ' . mysqli_connect_error());
        die('No se pudo establecer la conexión a la base de datos.');
    }
    mysqli_set_charset($conn, "utf8mb4");

if (isset($_POST['accion'])){
    switch ($_POST['accion']) {
        case 'agregar':
            //código para agregar
            break;
        case 'editar':
            //código para editar
            break;
        case 'borrar': //ver para deteccion de usuario (empleado/cliente)
            //código para borrar
            break;
        default:
            // Acción no reconocida
            break;

    }
}
    