<?php

namespace app\business\category;

use app\interfaces\RepositoryInterface;
use app\exceptions\DataException;

class CategoryDelete
{

  private RepositoryInterface $repository;

  public function __construct(RepositoryInterface $repository)
  {
    $this->repository = $repository;
  }

  public function delete(string $id)
  {
    if (!$this->repository->findById($id)["exists"]) {
      throw new DataException("La categoría que quieres eliminar no existe");
    }

    $this->repository->delete($id);
  }
}

?>