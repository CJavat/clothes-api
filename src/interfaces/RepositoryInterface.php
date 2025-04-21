<?php

namespace app\interfaces;

interface RepositoryInterface
{
  public function get();
  public function create($data);
  public function update(string $id, array $data);
  public function delete(string $id);
  public function findById(string $id);
}

?>