<?php

namespace app\business\cloth;

use app\interfaces\RepositoryInterface;
use app\exceptions\DataException;

class ClothDelete
{
  private RepositoryInterface $repository;

  public function __construct(RepositoryInterface $repository)
  {
    $this->repository = $repository;
  }

  public function delete(string $id)
  {
    if (!$this->repository->findById($id)) {
      throw new DataException("No existe la ropa que quieres eliminar");
    }

    $this->repository->delete($id);
  }
}


?>