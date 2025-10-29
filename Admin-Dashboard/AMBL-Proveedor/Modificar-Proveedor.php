<?php
include '../../php/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idproveedor = intval($_POST['idproveedor']);
    $nombreproveedor = trim($_POST['nombreproveedor']);
    $emailproveedor = trim($_POST['emailproveedor']);
    $telefonoproveedor = trim($_POST['telefonoproveedor']);

    if ($idproveedor <= 0) die("ID inválido");

    $stmt = mysqli_prepare($conn, "UPDATE proveedor SET nombreproveedor=?, emailproveedor=?, telefonoproveedor=? WHERE idproveedor=?");
    mysqli_stmt_bind_param($stmt, "sssi", $nombreproveedor, $emailproveedor, $telefonoproveedor, $idproveedor);
    mysqli_stmt_execute($stmt);

    header("Location: ../Proveedores.php");
    exit;
}

$id = isset($_GET['idproveedor']) ? intval($_GET['idproveedor']) : 0;
if ($id <= 0) {
    die("ID de proveedor no válido");
}

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
</head>
<body>
    <h2>Modificar Proveedor</h2>

    <form action="Modificar-Proveedor.php" method="post">
        <input type="hidden" name="idproveedor" value="<?= htmlspecialchars($proveedor['idproveedor']) ?>">

        Nombre: <input type="text" id="nombreproveedor" name="nombreproveedor" value="<?= htmlspecialchars($proveedor['nombreproveedor']) ?>" required><br>
        Email: <input type="email" id="emailproveedor" name="emailproveedor" value="<?= htmlspecialchars($proveedor['emailproveedor']) ?>" required><br>
        Teléfono: <input type="text" id="telefonoproveedor" name="telefonoproveedor" value="<?= htmlspecialchars($proveedor['telefonoproveedor']) ?>" required><br>

        <button type="submit">Modificar</button>
    </form>
</body>
</html>
