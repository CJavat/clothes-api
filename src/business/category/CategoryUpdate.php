<?php

namespace app\business\category;

use app\exceptions\DataException;
use app\exceptions\ValidationException;
use app\interfaces\RepositoryInterface;
use app\interfaces\CategoryValidatorInterface;


class CategoryUpdate
{
  private RepositoryInterface $repository;
  private CategoryValidatorInterface $validator;

  public function __construct(RepositoryInterface $repository, CategoryValidatorInterface $validator)
  {
    $this->repository = $repository;
    $this->validator = $validator;
  }

  public function update($data)
  {
    if (!$this->validator->validateCategoryUpdate($data)) {
      throw new ValidationException($this->validator->getCategoryError());
    }

    if (!$this->repository->findById($data["id"])["exists"]) {
      throw new DataException("La categoría no existe");
    }

    $this->repository->update($data);
  }
}



?>