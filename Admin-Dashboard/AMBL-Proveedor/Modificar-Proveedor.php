<?php

include '../../php/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtener y sanear datos recibidos
    $idproveedor = intval($_POST['idproveedor']);
    $nombreproveedor = trim($_POST['nombreproveedor']);
    $emailproveedor = trim($_POST['emailproveedor']);
    $telefonoproveedor = trim($_POST['telefonoproveedor']);

    // Validar ID
    if ($idproveedor <= 0) die("ID inválido");

    // Preparar y ejecutar la consulta de actualización usando sentencias preparadas
    $stmt = mysqli_prepare($conn, "UPDATE proveedor SET nombreproveedor=?, emailproveedor=?, telefonoproveedor=? WHERE idproveedor=?");
    mysqli_stmt_bind_param($stmt, "sssi", $nombreproveedor, $emailproveedor, $telefonoproveedor, $idproveedor);
    mysqli_stmt_execute($stmt);

    // Redirigir de nuevo a la lista de proveedores
    header("Location: ../Proveedores.php");
    exit;
}

// Si se carga la página para mostrar el formulario, obtener el id desde GET
$id = isset($_GET['idproveedor']) ? intval($_GET['idproveedor']) : 0;
if ($id <= 0) {
    die("ID de proveedor no válido");
}

// Consultar los datos del proveedor
$sql = $conn->query("SELECT * FROM proveedor WHERE idproveedor = $id");
$proveedor = $sql->fetch_assoc();
if (!$proveedor) {
    die("Proveedor no encontrado");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Proveedor</title>
    <link rel="stylesheet" href="../css/Mod-Provedor.css">
</head>
<body>

    <!-- Formulario para modificar proveedor -->
    <form action="Modificar-Proveedor.php" method="post">
        <a class="close" aria-label="Cerrar">&times;</a>
        <h2>Modificar Proveedor</h2>

        <!-- Campo oculto con el ID del proveedor -->
        <input type="hidden" name="idproveedor" value="<?= htmlspecialchars($proveedor['idproveedor']) ?>">

        <!-- Campos editables -->
        Nombre: <input type="text" id="nombreproveedor" name="nombreproveedor" value="<?= htmlspecialchars($proveedor['nombreproveedor']) ?>" required><br>
        Email: <input type="email" id="emailproveedor" name="emailproveedor" value="<?= htmlspecialchars($proveedor['emailproveedor']) ?>" required><br>
        Teléfono: <input type="text" id="telefonoproveedor" name="telefonoproveedor" value="<?= htmlspecialchars($proveedor['telefonoproveedor']) ?>" required><br>

        <button type="submit">Modificar</button>
    </form>
</body>

<script>
    // Cerrar "modal" o volver a la lista al hacer clic en la X
    document.querySelector('.close').addEventListener('click', function() {
        window.location.href = '../Proveedores.php';
    });
</script>

</html>
