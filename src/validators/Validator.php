<?php

namespace app\validators;

use app\interfaces\CategoryValidatorInterface;
use app\interfaces\ClothValidatorInterface;

class Validator implements ClothValidatorInterface, CategoryValidatorInterface
{
  private string $error;

  public function getClothError(): string
  {
    return $this->error;
  }

  public function validateClothAdd($data): bool
  {
    if (empty($data["name"])) {
      $this->error = "El nombre en la ropa es obligatorio";
      return false;
    }

    if (empty($data["type"])) {
      $this->error = "El tipo en la ropa es obligatorio";
      return false;
    }

    if (empty($data["category_id"])) {
      $this->error = "Dale una categoría a la camisa";
      return false;
    }

    return true;
  }

  public function validateClothUpdate($data): bool
  {
    if (empty($data["id"])) {
      $this->error = "Introduce el ID de la ropa";
      return false;
    }

    return true;
  }

  public function getCategoryError(): string
  {
    return $this->error;
  }

  public function validateCategoryAdd($data): bool
  {
    if (empty($data["name"])) {
      $this->error = "El nombre en la categoría es obligatorio";
      return false;
    }

    return true;
  }

  public function validateCategoryUpdate($data): bool
  {
    if (empty($data["id"])) {
      $this->error = "El ID es obligatorio";
      return false;
    }

    if (empty($data["name"])) {
      $this->error = "El nombre en la categoría es obligatorio";
      return false;
    }

    return true;
  }
}


?>