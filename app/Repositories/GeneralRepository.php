<?php

namespace App\Repositories;

use App\Interfaces\GeneralInterface;
use Illuminate\Database\Eloquent\Model;

class GeneralRepository implements GeneralInterface
{
    public function __construct(protected Model $model)
    {
    }

    public function withData(array $with)
    {
        return $this->model->with($with);
    }

    public function getData($with = [])
    {
        return $this->withData($with)->get();
    }

    public function getPaginated($with = [], $number)
    {
        return $this->withData($with)->paginate($number);
    }

    public function getBy($conditions = [], $with = [])
    {
        return $this->model->with($with)->where($conditions)->get();
    }

    public function getSpeseficeColum($colum, $conditions = [])
    {
        return $this->model->where($conditions)->pluck($colum);
    }

    public function getMultiColum($colums = [], $conditions = [])
    {
        return $this->model->where($conditions)->get($colums);
    }

    public function add($input)
    {
        try {
            return $this->model->firstOrCreate($input);
        } catch (\Throwable $th) {
            throw $th;
            return null;
        }
    }

    public function create($input)
    {
        return $this->model->create($input);
    }

    public function find($conditions)
    {
        return $this->model->where($conditions)->first();
    }

    public function findWith($conditions, $with = [], $withCount = [])
    {
        return $this->model->with($with)->withCount($withCount)->where($conditions)->first();
    }

    public function delete($conditions)
    {
        $row = $this->model->where($conditions)->first();
        $row->delete();
        return $row;
    }
}
