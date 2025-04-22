<?php

namespace app\business\category;

use app\interfaces\RepositoryInterface;

class CategoryGet
{
  private RepositoryInterface $repository;

  public function __construct(RepositoryInterface $repository)
  {
    $this->repository = $repository;
  }

  public function get(): array
  {
    return $this->repository->get();
  }
}

?>