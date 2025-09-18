<?php session_start();

    // Conexión a la base de datos
    $conexion = mysqli_connect("localhost", "root", "", "bdbarberia");
if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}
// Asegurar charset
mysqli_set_charset($conexion, "utf8mb4");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Definición de variables (evitar warnings si no existen)
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $contrasena = isset($_POST['password']) ? $_POST['password'] : '';

    // Verificar que el email exista en la base de datos y obtener la contraseña almacenada
    $check_stmt = mysqli_prepare($conexion, "SELECT idcliente, contrasena FROM clientes WHERE email = ?");
    if ($check_stmt) {
        mysqli_stmt_bind_param($check_stmt, "s", $email);
        mysqli_stmt_execute($check_stmt);

        // Compatibilidad sin get_result: usar store_result + bind_result + fetch
        mysqli_stmt_store_result($check_stmt);
        if (mysqli_stmt_num_rows($check_stmt) > 0) {
            mysqli_stmt_bind_result($check_stmt, $idcliente, $stored);
            mysqli_stmt_fetch($check_stmt);

            // Comparar contraseña en texto plano
            if ($contrasena === $stored) {
                $_SESSION['user_idcliente'] = $idcliente;
                $_SESSION['user_email'] = $email;
                header("Location: ../html/index.html");
                exit();
            } else {
                echo "Contraseña incorrecta.";
            }
        } else {
            echo "Usuario no encontrado.";
        }

        mysqli_stmt_close($check_stmt);
    } else {
        echo "Error en la preparación de la consulta: " . mysqli_error($conexion);
    }
}

mysqli_close($conexion);
?>
