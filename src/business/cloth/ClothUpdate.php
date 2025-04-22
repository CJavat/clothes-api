<?php

namespace app\business\cloth;

use app\exceptions\DataException;
use app\exceptions\ValidationException;
use app\interfaces\RepositoryInterface;
use app\interfaces\ClothValidatorInterface;

class ClothUpdate
{
  private RepositoryInterface $repository;
  private ClothValidatorInterface $validator;

  public function __construct(RepositoryInterface $repository, ClothValidatorInterface $validator)
  {
    $this->repository = $repository;
    $this->validator = $validator;
  }

  public function update($data)
  {

    if (!$this->validator->validateClothUpdate($data)) {
      throw new ValidationException($this->validator->getClothError());
    }

    if (!$this->repository->findById($data["id"])) {
      throw new DataException("No existe la ropa que quieres actualizar");
    }

    $this->repository->update($data);
  }
}

?>