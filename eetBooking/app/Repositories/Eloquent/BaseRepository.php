<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseRepositoryInterface
{
  protected Model $model;

  public function __construct(Model $model)
  {
    $this->model = $model;
  }

  public function all(): Collection
  {
    return $this->model->all();
  }

  public function find(int $id): ?Model
  {
    return $this->model->find($id);
  }

  public function create(array $attributes): Model
  {
    return $this->model->create($attributes);
  }

  public function update(int $id, array $attributes): bool
  {
    $model = $this->find($id);
    if ($model) {
      return $model->update($attributes);
    }
    return false;
  }

  public function delete(int $id): bool
  {
    $model = $this->find($id);
    if ($model) {
      return $model->delete();
    }
    return false;
  }
}
