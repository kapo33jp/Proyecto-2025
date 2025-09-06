<?php session_start();

    // Conexión a la base de datos
    $conexion = mysqli_connect("localhost", "root", "", "bdbarberia");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Definición de variables
    $email = $_POST['email'];
    $contrasena = $_POST['password'];

    //verificar que el email exista en la base de datos y obtener el hash de la contraseña
    $check_stmt = mysqli_prepare($conexion, "SELECT idcliente, email, contrasena FROM clientes WHERE email = ?");
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        $user = $check_result->fetch_assoc();

        // Verificar la contraseña
        if (password_verify($contrasena, $user['password'])) {
            $_SESSION['user_idcliente'] = $user['idcliente'];
            $_SESSION['user_email'] = $email;
            header("Location: index.html");
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }


    if (!$conexion) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    // Ejecutar
    if (mysqli_stmt_execute($stmt)) {
        // Cerrar conexión antes de redirigir
        mysqli_stmt_close($stmt);
        mysqli_close($conexion);

        header("Location: index.html"); 
        exit();
    } else {
        echo "Error: " . mysqli_error($conexion);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conexion);

    }
}
?>
