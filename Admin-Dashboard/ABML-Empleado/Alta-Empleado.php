<?php

include "../../php/conexion.php";


if(!empty($_POST['btnempleado'])){
    if(!empty($_POST['nombrebarbero']) && !empty($_POST['apellidobarbero']) && !empty($_POST['idbarbero']) && !empty($_POST['emailbarbero']) && !empty($_POST['contrasena']) && !empty($_POST['turno'])){
    
        $idbarbero = $_POST['idbarbero'];
        $nombrebarbero = $_POST['nombrebarbero'];
        $apellidobarbero = $_POST['apellidobarbero'];
        $emailbarbero = $_POST['emailbarbero'];
        $contrasena = $_POST['contrasena'];
        $turno = $_POST['turno'];

    $sql = $conexion->query("INSERT INTO barbero (idbarbero, nombrebarbero, apellidobarbero, emailbarbero, contrasena, turno) VALUES ('$idbarbero', '$nombrebarbero', '$apellidobarbero', '$emailbarbero', '$contrasena', '$turno')");

    if($sql==1){

        echo'<div class="alert alert-success">Empleado registrado correctamente</div>';
        header("   Location: ..//Admin-Dashboard/index.php");
    } else {
        echo '<div class="alert alert-danger">Error al registrar empleado</div>';
    }
} else {
    echo '<div class="alert alert-danger">Por favor complete todos los campos</div>';   
}
}
?>