<?php

namespace app\interfaces;

interface RepositoryInterface
{
  public function get();
  public function create($data);
  public function update($data);
  public function delete(string $id);
  public function findById(string $id);
}

?>