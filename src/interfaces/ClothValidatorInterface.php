<?php

namespace app\interfaces;

interface ClothValidatorInterface
{
  public function getClothError(): string;
  public function validateClothAdd($data): bool;
  public function validateClothUpdate($data): bool;
}

?>