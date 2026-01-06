<?php
require_once "conexion.php";
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Administrativo - Grand Hotel</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<div class="container login-container">
    <h1>Acceso Admin</h1>

    <form method="post">
        <label>Usuario</label>
        <input type="text" name="usuario" placeholder="Introduce tu usuario" required>
        
        <label>Contraseña</label>
        <input type="password" name="password" placeholder="••••••••" required>
        
        <input type="submit" value="Entrar al Sistema">
    </form>

    <?php
    if ($_POST) {
        $db = conectarBD();
        $user = $_POST['usuario'];
        $pass = hash('sha256', $_POST['password']);

        $sql = $db->prepare(
            "SELECT * FROM usuarios WHERE usuario=:u AND password=:p"
        );
        $sql->execute([
            ":u" => $user,
            ":p" => $pass
        ]);

        $usuario = $sql->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            $_SESSION['usuario'] = $usuario['usuario'];
            $_SESSION['rol'] = $usuario['rol'];
            header("Location: index.php");
            exit();
        } else {
            echo "<p style='color:red'>Usuario o contraseña incorrectos</p>";
        }
    }
    ?>
    
    <a href="index.php" class="back-link">← Volver al inicio</a>
</div>

</body>
</html>
