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
    if (!$this->repository->findById($id)) {
      throw new DataException("La ropa que quieres eliminar no existe");
    }

    $this->repository->delete($id);
  }
}

?>