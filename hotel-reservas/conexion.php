<?php
function conectarBD() {
    $db = json_decode(file_get_contents("credenciales.json"), true);

    try {
        $conn = new PDO(
            "mysql:host={$db['host']};dbname={$db['db']};charset=utf8",
            $db['username'],
            $db['password']
        );
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        exit("Error de conexión: " . $e->getMessage());
    }
}
?>
