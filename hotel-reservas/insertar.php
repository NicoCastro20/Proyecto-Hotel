<?php
require_once "auth.php";
protegerAdmin();
require_once "conexion.php";

if ($_POST) {
    $db = conectarBD();

    $sql = $db->prepare(
        "INSERT INTO reservas 
        (nombre_cliente, habitacion, fecha_entrada, fecha_salida, personas)
        VALUES (:n, :h, :e, :s, :p)"
    );

    $sql->execute([
        ":n" => $_POST['nombre'],
        ":h" => $_POST['habitacion'],
        ":e" => $_POST['entrada'],
        ":s" => $_POST['salida'],
        ":p" => $_POST['personas']
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
    <title>Nueva Reserva - Grand Hotel</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<div class="container">
    <h1>Nueva Reserva</h1>
    
    <a href="index.php" class="back-link">← Cancelar y volver</a>

    <form method="post">
        <label>Nombre del Cliente</label>
        <input type="text" name="nombre" placeholder="Nombre completo" required>

        <label>Número de Habitación</label>
        <input type="number" name="habitacion" placeholder="Ej: 101" required>

        <label>Fecha de Entrada</label>
        <input type="date" name="entrada" required>

        <label>Fecha de Salida</label>
        <input type="date" name="salida" required>

        <label>Número de Personas</label>
        <input type="number" name="personas" placeholder="Ej: 2" required>

        <input type="submit" value="Guardar Reserva">
    </form>
</div>

</body>
</html>
