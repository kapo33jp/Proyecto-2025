<?php
    include "conexion.php";
    if(!empty($_POST['boton-empleado'])){
        if(!empty($_POST['idbarbero']) and !empty($_POST['nombrebarbero']) and !empty($_POST['apellidobarbero']) and !empty($_POST['emailbarbero']) and !empty($_POST['turno']) and !empty($_POST['contrasena'])){


            $idbarbero = ['idbarbero'];
            $nombrebarbero = ['nombrebarbero'];
            $apellidobarbero = ['apellidobarbero'];
            $emailbarbero = ['apellidobarbero'];
            $turno = ['turno'];
            $contrasena = ['contrasena'];

            $sql = $conn-> query ("INSERT INTO barbero (idbarbero, nombrebarbero, apellidobarbero, emailbarbero, turno, contrasena) VALUES ('idbarbero','nombrebarbero','apellidobarbero','turno','contrasena')");
            if ($sql==1){
                echo '<div class = "alert alert-sucess">Persona registrada correctamente </div>';

                header("Location:");
                exit;
            

                }else{
                    echo '<div class = "alert alert-danger">Error al registrar</div>';
                }


                }else{
                    echo '<div class = "alert alert-warning">Algunos campos estan vacios</div>';
                }
            }
?>