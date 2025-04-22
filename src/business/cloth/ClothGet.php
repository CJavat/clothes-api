<?php

namespace app\business\cloth;

use app\interfaces\RepositoryInterface;

class ClothGet
{

  private RepositoryInterface $repository;

  public function __construct(RepositoryInterface $repository)
  {
    $this->repository = $repository;
  }

  public function get()
  {
    return $this->repository->get();
  }
}

?>