<?php
// Protocolo (http o https)
$protocolo = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";

// Dominio
$host = $_SERVER['HTTP_HOST'];

// Carpeta del proyecto (subcarpeta si existe)
$carpeta = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

// URL base de la aplicación
define("APP_URL", rtrim($protocolo . $host . $carpeta, "/"));

// URL absoluta de la carpeta public
define("PUBLIC_URL", APP_URL . "/public");

// Ruta absoluta en el servidor (sistema de archivos)
define("APP_PATH", realpath(__DIR__ . "/.."));
