<?php
require_once "auth.php";
protegerAdmin();
require_once "conexion.php";
$db = conectarBD();

$id = $_GET['id'];

$sql = $db->prepare("DELETE FROM reservas WHERE id=:id");
$sql->bindValue(":id", $id);
$sql->execute();

header("Location: index.php");
include "generar_json.php";
