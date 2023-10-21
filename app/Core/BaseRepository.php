<?php

namespace App\Core;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class BaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function findBy(string $key, string|int $value): Model
    {
        if (!is_null($model = $this->model->where($key, $value)->first())) {
            return $model;
        }
        throw new ModelNotFoundException("Donnée inexistante");
    }

    /**
     * return all subjects of model with pagination
     *
     * @param string $orderBy
     * @param integer $page
     * @return LengthAwarePaginator
     */
    public function allWithPagination(string $orderBy = 'id', int $page = 20): LengthAwarePaginator
    {
        return $this->model->orderBy($orderBy)->paginate($page);
    }

    /**
     * return all subjects of model with pagination
     *
     * @param string $orderBy
     * @param string $sortBy
     * @return Collection
     */
    public function all(string $orderBy = 'id', string $sortBy = 'asc'): Collection
    {
        return $this->model->orderBy($orderBy, $sortBy)->get();
    }

    /**
     * @param  $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findOneOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    /*
    public function findBy(array $data)
    {
        return $this->model->where($data)->get();
    } */

    /**
     * @param array $data
     * @return mixed
     */
    public function findOneBy(array $data)
    {
        return $this->model->where($data)->first();
    }

    /**
     * @param array $data
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findOneByOrFail(array $data)
    {
        return $this->model->where($data)->firstOrFail();
    }
}
