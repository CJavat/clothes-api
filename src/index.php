<?php
header("Content-Type: application/json");

require_once __DIR__ . "/../vendor/autoload.php";

use \Bramus\Router\Router;

// Crear instancia de router
$router = new Router();

$router->get("/", function () {
  echo json_encode("Hola desde Router");
});

//! Iniciar Router!
$router->run();
?>