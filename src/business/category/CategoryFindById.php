<?php

namespace app\business\category;

use app\interfaces\RepositoryInterface;

class CategoryFindById
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

    $this->repository->findById($id);
    return true;
  }
}

?>