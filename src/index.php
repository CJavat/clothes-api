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

$validator = new Validator();
$clothes_repository = new RepositoryDB("clothes");
$categories_repository = new RepositoryDB("categories");


//* Middleware
function safeHandler(callable $callback): callable
{
  return function (...$args) use ($callback) {
    try {
      $callback(...$args);
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
  };
}

//! Category
$router->get("/category", safeHandler(
  function () use ($categories_repository) {
    $get = new CategoryGet($categories_repository);
    echo json_encode($get->get());
  }
));

$router->get("/category/{id}", safeHandler(
  function ($id) use ($categories_repository) {
    $get = new CategoryFindById($categories_repository);
    $result = $get->findById($id);

    echo json_encode($result["data"]);
  }
));

$router->post("/category", safeHandler(
  function () use ($categories_repository, $validator) {
    $post = new CategoryAdd($categories_repository, $validator);
    $body = json_decode(file_get_contents("php://input"), true);
    $post->add($body);

    echo json_encode(["message" => "Categoría agregada correctamente"]);
  }
));

$router->put("/category", safeHandler(
  function () use ($categories_repository, $validator) {
    $put = new CategoryUpdate($categories_repository, $validator);
    $body = json_decode(file_get_contents("php://input"), true);
    $put->update($body);

    echo json_encode(["message" => "Categoría actualizada correctamente"]);
  }
));

$router->delete("/category/{id}", safeHandler(
  function ($id) use ($categories_repository) {
    $delete = new CategoryDelete($categories_repository);
    $delete->delete($id);

    echo json_encode(["message" => "La categoría se ha eliminado"]);
  }
));

//! Clothes
$router->get("/cloth", safeHandler(
  function () use ($clothes_repository) {
    $get = new ClothGet($clothes_repository);

    echo json_encode($get->get());
  }
));

$router->get("/cloth/{id}", safeHandler(
  function ($id) use ($clothes_repository) {
    $get = new ClothFindById($clothes_repository);

    echo json_encode($get->findById($id));
  }
));

$router->post("/cloth", safeHandler(
  function () use ($clothes_repository, $validator) {
    $post = new ClothAdd($clothes_repository, $validator);
    $body = json_decode(file_get_contents("php://input"), true);
    $post->add($body);

    echo json_encode(["message" => "La ropa se ha creado"]);
  }
));

$router->put("/cloth", safeHandler(
  function () use ($clothes_repository, $validator) {
    $put = new ClothUpdate($clothes_repository, $validator);
    $body = json_decode(file_get_contents("php://input"), true);
    $put->update($body);

    echo json_encode(["message" => "Ropa actualizada correctamente"]);
  }
));

$router->delete("/cloth/{id}", safeHandler(
  function ($id) use ($clothes_repository) {
    $delete = new ClothDelete($clothes_repository);
    $delete->delete($id);

    echo json_encode(["message" => "Ropa eliminada exitosamente"]);
  }
));

$router->set404(function () {
  http_response_code(405);

  echo json_encode(["message" => "Method not allow"]);
});

//! Iniciar Router!
$router->run();
?>