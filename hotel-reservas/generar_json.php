<?php
require_once "conexion.php";

$db = conectarBD();
$sql = $db->query("SELECT * FROM reservas");
$reservas = $sql->fetchAll(PDO::FETCH_ASSOC);

$json = json_encode($reservas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

file_put_contents("reservas.json", $json);


