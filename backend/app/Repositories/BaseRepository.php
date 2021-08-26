<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

abstract class BaseRepository
{
    /**
     * Per Page
     * @var int $perPage
     */
    public $perPage = 10;

    /**
     * All the Repository class must have an model method which should return the Model Class
     *
     */
    abstract function model();

    public function query(): Builder
    {
        return $this->model()->query();
    }

    public function paginate($perPage = 10, array $with = []) : LengthAwarePaginator
    {
        $this->perPage = $perPage;
        $query = $this->query();
        if (count($with) > 0) {
            return $query->with($with)->paginate($perPage);
        }
        return $query->paginate($perPage);
    }

    public function create(array $data)
    {
        return $this->model()->create($data);
    }

    public function find(int $id)
    {
        return $this->model()->find($id);
    }

    /**
     * Delete Model Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id) : int
    {
        return (new static())->find($id)->delete();
    }

    public function all() : Collection
    {
        return $this->model()->all();
    }

}
