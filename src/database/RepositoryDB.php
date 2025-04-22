<?php

namespace app\database;

use app\exceptions\DataException;
use PDO;
use Ramsey\Uuid\Uuid;
use app\database\BaseRepository;
use app\interfaces\RepositoryInterface;

class RepositoryDB extends BaseRepository implements RepositoryInterface
{
  private $table_name;

  public function __construct(string $table_name)
  {
    parent::__construct();
    $this->table_name = $table_name;
  }

  public function get()
  {
    $query = "SELECT * FROM " . $this->table_name;

    $stmt = $this->pdo->prepare($query);
    $stmt->execute();

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $data;
  }

  public function create($data)
  {
    $uuid = Uuid::uuid4();
    $data["id"] = $uuid->toString();
    $query = "";

    if ($this->table_name === "categories") {
      $query = "INSERT INTO " . $this->table_name . " (id, name) VALUES (:id, :name)";
    } else if ($this->table_name === "clothes") {
      $data["fabric"] = isset($data["fabric"]) ? $data["fabric"] : null;
      $query = "INSERT INTO " . $this->table_name . " (id, name, type, fabric, category_id) VALUES (:id, :name, :type, :fabric, :category_id)";
    }

    $stmt = $this->pdo->prepare($query);
    $stmt->execute($data);
  }

  public function update($data)
  {
    $query = "";

    if ($this->table_name === "categories") {
      $query = "UPDATE " . $this->table_name . " SET name = :name WHERE id = :id";
    } else if ($this->table_name === "clothes") {
      $cloth = $this->findById($data["id"])["data"];

      $data["name"] = isset($data["name"]) ? $data["name"] : $cloth["name"];
      $data["type"] = isset($data["type"]) ? $data["type"] : $cloth["type"];
      $data["fabric"] = isset($data["fabric"]) ? $data["fabric"] : $cloth["fabric"];
      $data["category_id"] = isset($data["category_id"]) ? $data["category_id"] : $cloth["category_id"];

      $query = "UPDATE " . $this->table_name
        . " SET name = :name, type = :type, fabric = :fabric, category_id = :category_id"
        . " WHERE id = :id";
    }

    $stmt = $this->pdo->prepare($query);
    $stmt->execute($data);
  }

  public function delete($id)
  {
    $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
    $stmt = $this->pdo->prepare($query);
    $stmt->execute(["id" => $id]);
  }

  public function findById($id)
  {
    $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
    $stmt = $this->pdo->prepare($query);
    $stmt->execute(["id" => $id]);
    $exists = $stmt->rowCount() > 0;
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    return ["exists" => $exists, "data" => $data ? $data : []];
  }

}

?>