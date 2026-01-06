<?php
require_once "conexion.php";
require_once "auth.php";
$db = conectarBD();

$sql = $db->query("SELECT * FROM reservas ORDER BY id DESC");
$reservas = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Reservas - Gran Hotel</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<div class="container">
    <h1>Gestión de Reservas</h1>

    <div class="nav-bar">
        <?php if (esAdmin()): ?>
            <span>Bienvenido, <strong><?= htmlspecialchars($_SESSION['usuario']) ?></strong></span>
            <div class="nav-links">
                <a href="insertar.php">Nueva reserva</a>
                <a href="logout.php" class="btn-danger">Cerrar sesión</a>
            </div>
        <?php else: ?>
            <span>Bienvenido al sistema de reservas</span>
            <div class="nav-links">
                <a href="login.php">Iniciar Sesión</a>
            </div>
        <?php endif; ?>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Habitación</th>
                <th>Entrada</th>
                <th>Salida</th>
                <th>Personas</th>
                <?php if (esAdmin()): ?>
                    <th>Acciones</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reservas as $r): ?>
            <tr>
                <td>#<?= $r['id'] ?></td>
                <td><strong><?= htmlspecialchars($r['nombre_cliente']) ?></strong></td>
                <td>Hab. <?= $r['habitacion'] ?></td>
                <td><?= $r['fecha_entrada'] ?></td>
                <td><?= $r['fecha_salida'] ?></td>
                <td><?= $r['personas'] ?> pers.</td>

                <?php if (esAdmin()): ?>
                <td>
                    <a href="editar.php?id=<?= $r['id'] ?>">Editar</a>
                    <a href="borrar.php?id=<?= $r['id'] ?>" 
                       onclick="return confirm('¿Estás seguro de eliminar esta reserva?')">Eliminar</a>
                </td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
