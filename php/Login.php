<?php 
session_start();

$host = 'localhost';
$user = 'root';
$pass = ''; 
$db   = 'bdbarberia';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_errno) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    die("Error de conexión MySQL: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $contrasena = isset($_POST['password']) ? $_POST['password'] : '';

    // Verificar usuario y contraseña
    $check_stmt = mysqli_prepare($conn, "SELECT idusuario, contrasena, idrol FROM usuarios WHERE email = ?");
    if ($check_stmt) {
        mysqli_stmt_bind_param($check_stmt, "s", $email);
        mysqli_stmt_execute($check_stmt);
        mysqli_stmt_store_result($check_stmt);

        if (mysqli_stmt_num_rows($check_stmt) > 0) {
            mysqli_stmt_bind_result($check_stmt, $idusuario, $stored, $idrol);
            mysqli_stmt_fetch($check_stmt);

            if ($contrasena === $stored) {
                // Guardar sesión
                $_SESSION['user_idusuario'] = $idusuario;
                $_SESSION['user_email'] = $email;
                $_SESSION['user_idrol'] = $idrol;

                // Redirigir según el rol
                switch ($idrol) {
                    case 1: // Admin
                        header("Location: ../Admin-Dashboard/index.php");
                        break;
                    case 2: // Empleado
                        header("Location: ../Admin-Dashboard/index.php");
                        break;
                    case 3: // Cliente
                        header("Location: ../html/Main.php");
                        break;
                    default:
                        echo "Rol desconocido.";
                        exit();
                }
                exit();
            } else {
                echo "Contraseña incorrecta.";
            }
        } else {
            echo "Usuario no encontrado.";
        }

        mysqli_stmt_close($check_stmt);
    } else {
        echo "Error en la preparación de la consulta: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
