<?php

    //Definicion de las variables

    $usuario = $_POST['Usuario'];
    $contrasena = $_POST['Contrasena'];

    //conexion a la base de datos

    $conexion = mysqli_connect("localhost", "root", "", "bdbarberia");

    $consulta = "SELECT * FROM `Usuarios` WHERE Usuario = '$usuario' AND Contrasena = '$contrasena'";

    $resultado = mysqli_query($conexion, $consulta);

    $filas = mysqli_num_rows($resultado);

    if($filas>0){
        header("Location: index.html");
        
    }else{
        echo "Error en la autenticacion";

    }

    mysqli_free_result($resultado);
    mysqli_close($conexion);