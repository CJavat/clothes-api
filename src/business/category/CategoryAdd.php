<?php

namespace app\business\category;

use app\exceptions\ValidationException;
use app\interfaces\RepositoryInterface;
use app\interfaces\CategoryValidatorInterface;

class CategoryAdd
{
  private RepositoryInterface $repository;
  private CategoryValidatorInterface $validator;

  public function __construct(RepositoryInterface $repository, CategoryValidatorInterface $validator)
  {
    $this->repository = $repository;
    $this->validator = $validator;
  }

  public function add($data)
  {
    if (!$this->validator->validateCategoryAdd($data)) {
      throw new ValidationException($this->validator->getCategoryError());
    }

    $this->repository->create($data);
  }
}

?>