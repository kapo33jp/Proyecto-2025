<?php

    include '../php/conexion.php';

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
    