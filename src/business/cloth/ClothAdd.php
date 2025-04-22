<?php

namespace app\business\cloth;

use app\interfaces\RepositoryInterface;
use app\interfaces\ClothValidatorInterface;
use app\exceptions\ValidationException;

class ClothAdd
{
  private RepositoryInterface $repository;
  private ClothValidatorInterface $validator;

  public function __construct(RepositoryInterface $repository, ClothValidatorInterface $validator)
  {
    $this->repository = $repository;
    $this->validator = $validator;
  }

  public function add($data)
  {
    if (!$this->validator->validateClothAdd($data)) {
      throw new ValidationException($this->validator->getClothError());
    }

    $this->repository->create($data);
  }
}

?>