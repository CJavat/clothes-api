<?php

namespace app\business\cloth;

use app\interfaces\RepositoryInterface;

class ClothFindById
{
  private RepositoryInterface $repository;

  public function __construct(RepositoryInterface $repository)
  {
    $this->repository = $repository;
  }

  public function findById(string $id)
  {
    if (empty($id)) {
      return false;
    }

    return $this->repository->findById($id);
  }
}

?>