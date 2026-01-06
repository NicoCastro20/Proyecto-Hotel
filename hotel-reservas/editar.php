<?php
require_once "auth.php";
protegerAdmin();
require_once "conexion.php";
$db = conectarBD();

$id = $_GET['id'];

$sql = $db->prepare("SELECT * FROM reservas WHERE id=:id");
$sql->bindValue(":id", $id);
$sql->execute();
$reserva = $sql->fetch(PDO::FETCH_ASSOC);

if ($_POST) {
    $sql = $db->prepare(
        "UPDATE reservas SET
        nombre_cliente=:n,
        habitacion=:h,
        fecha_entrada=:e,
        fecha_salida=:s,
        personas=:p
        WHERE id=:id"
    );

    $sql->execute([
        ":n" => $_POST['nombre'],
        ":h" => $_POST['habitacion'],
        ":e" => $_POST['entrada'],
        ":s" => $_POST['salida'],
        ":p" => $_POST['personas'],
        ":id" => $id
    ]);

    include "generar_json.php";
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reserva #<?= $id ?> - Grand Hotel</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<div class="container">
    <h1>Editar Reserva #<?= $id ?></h1>
    
    <a href="index.php" class="back-link">← Cancelar y volver</a>

    <form method="post">
        <label>Nombre del Cliente</label>
        <input type="text" name="nombre" value="<?= htmlspecialchars($reserva['nombre_cliente']) ?>" required>
        
        <label>Número de Habitación</label>
        <input type="number" name="habitacion" value="<?= $reserva['habitacion'] ?>" required>
        
        <label>Fecha de Entrada</label>
        <input type="date" name="entrada" value="<?= $reserva['fecha_entrada'] ?>" required>

        <label>Fecha de Salida</label>
        <input type="date" name="salida" value="<?= $reserva['fecha_salida'] ?>" required>

        <label>Número de Personas</label>
        <input type="number" name="personas" value="<?= $reserva['personas'] ?>" required>

        <input type="submit" value="Actualizar Reserva">
    </form>
</div>

</body>
</html>
