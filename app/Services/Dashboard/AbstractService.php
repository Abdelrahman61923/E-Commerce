<?php

namespace App\Services\Dashboard;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractService
{
    protected Model $model;

    protected array $with = [];
    protected array $withCount = [];

    abstract protected function model(): Model;

    public function __construct()
    {
        $this->model = $this->model();
    }

    public function getAll(int $perPage = 10)
    {
        return $this->model
            ->with($this->with)
            ->withCount($this->withCount)
            ->latest()
            ->paginate($perPage);
    }

    public function add(array $data): Model
    {
        $model = $this->model->create($data);
        return $model;
    }

    public function update(Model $model, array $data): Model
    {
        $model->update($data);
        return $model;
    }

    public function delete(Model $model): bool
    {
        return $model->delete();
    }
}
