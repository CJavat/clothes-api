<?php

namespace app\database;

use PDO;
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

    return [$data];
  }

  public function create($data)
  {
    //TODO: Falta de implementar.
    print_r($data);
  }

  public function update($data)
  {
    //TODO: Falta de implementar.
    print_r($data);
  }

  public function delete($id)
  {
    //TODO: Falta de implementar.
    print_r($id);
  }

  public function findById($id)
  {
    //TODO: Falta de implementar.
    print_r($id);
  }

}

?>