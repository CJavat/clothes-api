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
    $this->table_name = $table_name;
  }

  public function get()
  {
    //TODO: Falta de implementar.
    echo "get";
  }

  public function create($data)
  {
    //TODO: Falta de implementar.
    print_r($data);
  }

  public function update($id, $data)
  {
    //TODO: Falta de implementar.
    print_r($data, $id);
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