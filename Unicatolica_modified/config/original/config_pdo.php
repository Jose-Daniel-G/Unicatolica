<?php
$server   = "localhost";
$user     = "root";
$password = "";
$database = "morado_conferencia";

try {
    $pdo = new PDO("mysql:host=$server;dbname=$database;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Opcional: que devuelva los resultados como array asociativo por defecto
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Devolvemos un JSON con el error (útil si es backend para AJAX)
    die(json_encode(["error" => "Error de conexión: " . $e->getMessage()]));
}
