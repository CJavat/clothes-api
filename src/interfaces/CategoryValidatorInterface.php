<?php

namespace app\interfaces;

interface CategoryValidatorInterface
{
  public function getCategoryError(): string;
  public function validateCategoryAdd($data): bool;
  public function validateCategoryUpdate($data): bool;
}

?>