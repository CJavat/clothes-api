<?php

header("Content-Type: application/json");

require_once __DIR__ . "/../vendor/autoload.php";

use \Bramus\Router\Router;

use app\database\RepositoryDB;
use app\validators\Validator;

use app\business\category\CategoryGet;
use app\business\category\CategoryAdd;
use app\business\category\CategoryUpdate;
use app\business\category\CategoryDelete;
use app\business\category\CategoryFindById;

use app\business\cloth\ClothGet;
use app\business\cloth\ClothAdd;
use app\business\cloth\ClothUpdate;
use app\business\cloth\ClothDelete;
use app\business\cloth\ClothFindById;

use app\exceptions\DataException;
use app\exceptions\ValidationException;



// Crear instancia de router
$router = new Router();

$cloth_repository = new RepositoryDB("clothes");
$categories_repository = new RepositoryDB("categories");

try {

  $router->get("/category", function () use ($categories_repository) {
    $get = new CategoryGet($categories_repository);
    echo json_encode($get->get());
  });
} catch (ValidationException $e) {
  http_response_code(400);
  echo json_encode(["validationError" => $e->getMessage()]);
} catch (DataException $e) {
  http_response_code(404);
  echo json_encode(["dataError" => $e->getMessage()]);
} catch (PDOException $e) {
  http_response_code(404);
  echo json_encode(["pdoError" => $e->getMessage()]);
} catch (\Exception $e) {
  http_response_code(500);
  echo json_encode(["exceptionError" => $e->getMessage()]);
} catch (TypeError $e) {
  http_response_code(400);
  echo json_encode(["typeError" => $e->getMessage()]);
}

$router->set404(function () {
  http_response_code(405);

  echo json_encode(["message" => "Method not allow"]);
});

//! Iniciar Router!
$router->run();
?>